<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class EditUser extends Component
{
    public User $user;

    // 1. Ganti Form Object jadi Array
    public $form = [];

    // 2. Password dipisah (karena tidak diambil dari DB saat edit)
    public $password = '';
    public $password_confirmation = '';

    public function mount(User $user)
    {
        $this->user = $user;

        // 3. Masukkan data User ke dalam Array form
        $this->form = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'phone' => $user->phone,
            'address' => $user->address,
        ];
    }

    public function save(UserService $userService)
    {
        // 4. Validasi Array (Gunakan 'form.namafield')
        $this->validate([
            'form.name' => 'required|string|max:255',
            'form.email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'form.role' => 'required|in:Pustakawan,Anggota',
            'form.phone' => 'required|string|max:50',
            'form.address' => 'required|string',
            'password' => 'nullable|min:8|confirmed', // Validasi password terpisah
        ]);

        // Ambil data dari array
        $data = $this->form;

        // Cek jika password diisi, maka hash dan masukkan ke data
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        // Update via Service
        $userService->updateUser($this->user, $data);

        session()->flash('message', 'User updated successfully.');

        return redirect()->route('admin.users');
    }

    public function render()
    {
        return view('livewire.admin.user.edit-user');
    }
}
