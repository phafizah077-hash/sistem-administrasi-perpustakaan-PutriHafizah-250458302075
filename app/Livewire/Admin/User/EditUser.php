<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use App\Services\UserService;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class EditUser extends Component
{
    public User $user;

    public $name;
    public $email;
    public $role;
    public $phone;
    public $address;

    public $password = '';
    public $password_confirmation = '';

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->phone = $user->phone;
        $this->address = $user->address;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'role' => 'required|in:Pustakawan,Anggota',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'password' => 'nullable|min:8|confirmed',
        ];
    }

    // --- TAMBAHAN 1: Agar Error Hilang Real-time ---
    public function updated($propertyName)
    {
        // Fungsi ini mengecek validasi setiap kali ada data berubah/blur
        $this->validateOnly($propertyName);
    }

    // --- TAMBAHAN 2: Translate Bahasa Indonesia ---
    public function messages()
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan user lain.',
            'role.required' => 'Wajib memilih role.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }

    public function save(UserService $userService)
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'phone' => $this->phone,
            'address' => $this->address,
        ];

        if (!empty($this->password)) {
            $data['password'] = $this->password;
        }

        $userService->updateUser($this->user, $data);

        session()->flash('message', 'User berhasil diperbarui.');

        return redirect()->route('admin.users');
    }

    public function render()
    {
        return view('livewire.admin.user.edit-user');
    }
}
