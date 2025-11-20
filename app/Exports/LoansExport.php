<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoansExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Loan::with(['user', 'book'])->where('status', 'borrowed')->get();
    }

    public function headings(): array
    {
        return [
            'Peminjam',
            'Buku',
            'Tanggal Pinjam',
            'Tanggal Jatuh Tempo',
            'Status',
        ];
    }

    public function map($loan): array
    {
        return [
            $loan->user->name,
            $loan->book->title,
            $loan->loan_date->format('d M Y'),
            $loan->due_date->format('d M Y'),
            ucfirst($loan->status),
        ];
    }
}
