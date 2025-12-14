<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;

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
            // UBAH DARI 'required' JADI 'nullable'
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
        ];
    }

    // Custom pesan error (Opsional, biar bahasa Indonesia)
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
            // Pesan required untuk phone dan address dihapus karena sudah tidak wajib
        ];
    }

    public function updated($propertyName)
    {
        // PERBAIKAN DI SINI:
        // Jika sedang mengetik 'password', kita validasi HANYA required & min
        // Kita HILANGKAN 'confirmed' agar tidak error sebelum mengisi kolom konfirmasi
        if ($propertyName === 'password') {
            $this->validateOnly($propertyName, [
                'password' => 'required|min:8',
            ]);
        } else {
            // Untuk field lain (termasuk name, email, dll) validasi seperti biasa
            $this->validateOnly($propertyName);
        }
    }

    public function save()
    {
        // Validasi penuh tetap dijalankan di sini (termasuk 'confirmed')
        // Jadi saat tombol simpan ditekan, password konfirmasi wajib cocok
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,

            // Jika $this->phone kosong (null), ganti jadi string kosong ""
            'phone' => $this->phone ?? '',

            // Sama juga untuk address
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
