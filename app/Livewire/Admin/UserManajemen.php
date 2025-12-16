<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]

class UserManajemen extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function deleteUser($userId)
    {
        if ($userId == auth()->id()) {
            session()->flash('error', 'You cannot delete yourself.');

            return;
        }

        User::find($userId)->delete();
        session()->flash('message', 'User berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.user-manajemen', [
            'users' => User::latest()->paginate(10),
        ]);
    }
}
