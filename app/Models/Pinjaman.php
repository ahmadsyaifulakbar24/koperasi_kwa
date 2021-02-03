<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;
    protected $table = 'pinjaman';

    protected $fillable = [
        'user_id',
        'angsuran',
        'besar_pinjaman',
        'tenor',
        'total_bayar',
        'sisa_bayar',
        'status',
        'approved_date',
        'paid_off_date',
    ];
}
