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
        'transaction_type',
        'description',
        'contract',
        'approved_date',
        'paid_off_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'pinjaman_id');
    }
}
