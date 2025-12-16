<?php

namespace App\Livewire\Member;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class NotificationUser extends Component
{
    public Collection $notifications;

    #[On('notification-triggered')]
    #[On('refreshNotifications')]
    public function mount()
    {
        $this->notifications = new Collection;
        $this->refreshNotifications();
    }

    public function refreshNotifications()
    {
        if (! Auth::check()) {
            $this->notifications = new Collection;

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

        Notification::where('id', $notificationId)->where('user_id', $user->id)->delete();

        $this->dispatch('refreshNotifications');
    }

    public function markAllAsRead()
    {
        /** @var User $user */
        $user = Auth::user();

        Notification::where('user_id', $user->id)->delete();
        $this->dispatch('refreshNotifications');
    }

    public function render()
    {
        return view('livewire.member.notification-user');
    }
}
