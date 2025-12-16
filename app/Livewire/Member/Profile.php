<?php

namespace App\Livewire\Member;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Profile extends Component
{
    #[Rule('required|string|max:255')]
    public string $name = '';

    #[Rule('required|email|max:255')]
    public string $email = '';

    #[Rule('nullable|string|max:255')]
    public string $address = '';

    #[Rule('nullable|string|max:20')]
    public string $phone = '';

    #[Rule('nullable|string|min:8|confirmed')]
    public string $password = '';

    #[Rule('nullable|required_with:password|min:8')]
    public string $password_confirmation = '';

    public bool $isEditing = false;

    protected $userService;

    public function boot(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function mount()
    {
        $this->setUserData();
    }

    public function edit()
    {
        $this->isEditing = true;
    }

    public function cancel()
    {
        $this->isEditing = false;
        $this->setUserData();
        $this->resetErrorBag();
    }

    public function update()
    {
        $userId = Auth::id();
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$userId,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar.',
            'address.string' => 'Alamat harus berupa teks.',
            'address.max' => 'Alamat maksimal 255 karakter.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $this->userService->updateUser(Auth::user(), $validatedData);

        $this->isEditing = false;

        // Pesan sukses dihapus, hanya dispatch event saja jika diperlukan trigger lain
        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.member.profile');
    }

    private function setUserData(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->address = $user->address ?? '';
        $this->phone = $user->phone ?? '';
        $this->password = '';
        $this->password_confirmation = '';
    }
}
