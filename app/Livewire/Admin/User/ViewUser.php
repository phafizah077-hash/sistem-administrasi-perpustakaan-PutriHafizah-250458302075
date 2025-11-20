<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewUser extends Component
{
    public ?User $user = null;

    #[On('view-user-detail')]
    public function showUser(int $userId)
    {
        $this->user = User::find($userId);
    }

    public function render()
    {
        return view('livewire.admin.user.view-user');
    }
}
