<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\Notification;
use Carbon\Carbon;

class NotificationService
{
    public function sendDueDateWarnings(int $daysBefore = 3): int
    {
        $targetDate = Carbon::now()->addDays($daysBefore)->toDateString();
        $loans = Loan::where('status', 'borrowed')
            ->whereDate('due_date', $targetDate)
            ->get();

        foreach ($loans as $loan) {
            Notification::firstOrCreate(
                [
                    'loan_id' => $loan->id,
                    'type' => 'due_date_warning',
                ],
                [
                    'user_id' => $loan->user_id,
                    'message' => "Peminjaman buku '{$loan->book->title}' akan jatuh tempo dalam {$daysBefore} hari pada tanggal {$loan->due_date->format('d-m-Y')}.",
                ]
            );
        }

        return $loans->count();
    }

    public function sendOverdueAlerts(): int
    {
        $yesterday = Carbon::yesterday()->endOfDay();
        $loans = Loan::where('status', 'borrowed')
            ->where('due_date', '<', $yesterday)
            ->get();

        foreach ($loans as $loan) {
            $fineMessage = 'Anda akan dikenakan denda atas keterlambatan pengembalian ini sesuai kebijakan perpustakaan.';

            Notification::firstOrCreate(
                [
                    'loan_id' => $loan->id,
                    'type' => 'overdue_alert',
                ],
                [
                    'user_id' => $loan->user_id,
                    'message' => "Peringatan! Peminjaman buku '{$loan->book->title}' telah melewati tanggal jatuh tempo ({$loan->due_date->format('d-m-Y')}). {$fineMessage} Mohon segera kembalikan.",
                ]
            );
        }

        return $loans->count();
    }
}
