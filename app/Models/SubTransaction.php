<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTransaction extends Model
{
    use HasFactory;
    
    protected $table = 'sub_transactions';

    protected $fillable = [
        'transaction_id',
        'type',
        'besaran',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
