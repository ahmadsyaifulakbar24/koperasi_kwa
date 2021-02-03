<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'bukti_pembayaran',
        'approved_date',
    ];

    public function sub_transaction()
    {
        return $this->hasMany(SubTransaction::class, 'transaction_id');
    }
}
