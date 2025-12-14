<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoansExport implements FromCollection, WithHeadings, WithMapping
{
    protected $loans;

    public function __construct(Collection $loans)
    {
        $this->loans = $loans;
    }

    public function collection()
    {
        return $this->loans;
    }

    public function headings(): array
    {
        return [
            'Peminjam',
            'Buku',
            'Tanggal Pinjam',
            'Tanggal Jatuh Tempo',
            'Status',
            'Denda',
        ];
    }

    public function map($loan): array
    {
        $fineAmount = 0;
        if (now()->startOfDay()->gt($loan->due_date->startOfDay())) {
            $due = $loan->due_date->startOfDay();
            $now = now()->startOfDay();
            $diffInDays = $due->diffInDays($now);
            $fineAmount = $diffInDays * 3000;
        }

        return [
            $loan->user->name,
            $loan->book->title,
            $loan->loan_date->format('d M Y'),
            $loan->due_date->format('d M Y'),
            ucfirst($loan->status),
            $fineAmount,
        ];
    }
}
