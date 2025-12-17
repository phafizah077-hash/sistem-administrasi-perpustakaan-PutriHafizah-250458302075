<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class CreateUser extends Component
{
    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public $role;

    public $phone;

    public $address;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:Pustakawan,Anggota',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Silakan pilih peran (role).',
        ];
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'password') {
            $this->validateOnly($propertyName, [
                'password' => 'required|min:8',
            ]);
        } else {
            $this->validateOnly($propertyName);
        }
    }

    public function save()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'phone' => $this->phone ?? '',
            'address' => $this->address ?? '',
        ]);

        session()->flash('message', 'User berhasil ditambahkan.');

        return $this->redirect(route('admin.users'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.user.create-user');
    }
}
