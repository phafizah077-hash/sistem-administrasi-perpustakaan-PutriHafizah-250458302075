<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Illuminate\Validation\ValidationException;

new #[Layout('components.layouts.auth')]
#[Title('Login - BookifyLibrary')]
class extends Component {
    public LoginForm $form;

    public function messages()
    {
        return [
            'form.email.required' => 'Alamat email wajib diisi.',
            'form.email.email' => 'Format email tidak valid.',
            'form.password.required' => 'Password wajib diisi.',
        ];
    }

    public function login(): void
    {
        $this->validate();

        try {
            $this->form->authenticate();
        } catch (ValidationException $e) {
            throw ValidationException::withMessages([
                'form.email' => 'Email atau password yang Anda masukkan salah.',
            ]);
        }

        Session::regenerate();

        $user = Auth::user();

        if ($user->role === 'Anggota') {
            $this->redirectIntended(default: route('home', absolute: false));
        } else {
            $this->redirectIntended(default: route('admin.dashboard', absolute: false));
        }
    }
}; ?>

<div class="min-h-screen flex">
    <div class="hidden lg:block w-1/2 relative bg-slate-900">
        <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&q=80&w=1000"
            alt="Library Background"
            class="absolute inset-0 w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-900/60 to-slate-900/90"></div>
        <div class="absolute bottom-0 left-0 p-12 text-white z-10">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-indigo-500 p-2 rounded-lg">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <span class="font-bold text-3xl tracking-tight">Bookify<span class="text-indigo-400">Library</span></span>
            </div>
            <p class="text-lg text-slate-300 leading-relaxed max-w-md">
                "Buku adalah jendela dunia. Masuk untuk mulai menjelajahi ribuan koleksi pengetahuan tanpa batas."
            </p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 bg-white">
        <div class="w-full max-w-md space-y-8">

            <div class="lg:hidden text-center mb-8">
                <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-2">
                    <div class="bg-indigo-600 p-2 rounded-lg">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="font-bold text-2xl text-slate-900">Bookify<span class="text-indigo-600">Library</span></span>
                </a>
            </div>

            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-bold text-slate-900">Selamat Datang</h2>
                <p class="mt-2 text-sm text-slate-500">Silakan masukkan detail akun Anda untuk masuk.</p>
                <x-auth-session-status class="mb-4" :status="session('status')" />
            </div>

            <form wire:submit="login" class="mt-8 space-y-6">
                <div class="space-y-1">
                    <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input wire:model="form.email" id="email" type="email" required autofocus autocomplete="username"
                            class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition"
                            placeholder="nama@email.com">
                    </div>
                    @error('form.email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1">
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input wire:model="form.password" id="password" type="password" required autocomplete="current-password"
                            class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition"
                            placeholder="••••••••">
                    </div>
                    @error('form.password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-indigo-500/30 relative">
                        <span wire:loading.remove>Masuk Sekarang</span>
                        <span wire:loading>Memproses...</span>
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p class="text-sm text-slate-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Daftar Disini</a>
                </p>
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-slate-600 flex items-center justify-center gap-1 transition">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
