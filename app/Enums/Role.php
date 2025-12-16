<?php

namespace App\Enums;

enum Role: string
{
    // Sesuaikan value string ini dengan yang ada di database kamu
    case Pustakawan = 'Pustakawan';
    case Anggota = 'Anggota';
}
