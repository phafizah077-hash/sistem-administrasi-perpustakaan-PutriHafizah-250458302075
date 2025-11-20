<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout; // <--- Pastikan baris ini ada

// Arahkan ke: resources/views/components/layouts/admin.blade.php
#[Layout('components.layouts.admin')]

class UserManajemen extends Component
{
    use WithPagination;

    public function deleteUser($userId)
    {
        if ($userId == auth()->id()) {
            session()->flash('error', 'You cannot delete yourself.');
            return;
        }
        
        User::find($userId)->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.user-manajemen', [
            'users' => User::latest()->paginate(10),
        ]);
    }
}