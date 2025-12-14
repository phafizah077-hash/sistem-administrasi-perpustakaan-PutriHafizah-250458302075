<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class NotificationUser extends Component
{
    public Collection $notifications;

    #[On('notification-triggered')]
    #[On('refreshNotifications')]

    public function mount()
    {
        $this->notifications = new Collection();
        $this->refreshNotifications();
    }

    public function refreshNotifications()
    {
        if (!Auth::check()) {
            $this->notifications = new Collection();
            return;
        }

        /** @var User $user */
        $user = Auth::user();
        $this->notifications = $user
            ->notifications()
            ->latest()
            ->get();
    }

    public function dismiss(int $notificationId)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($notification = $user->notifications()->find($notificationId)) {
            $notification->delete();
        }

        $this->refreshNotifications();
    }

    public function markAllAsRead()
    {
        /** @var User $user */
        $user = Auth::user();

        $user->notifications()->delete();
        $this->refreshNotifications();
    }


    public function render()
    {
        return view('livewire.member.notification-user');
    }
}
