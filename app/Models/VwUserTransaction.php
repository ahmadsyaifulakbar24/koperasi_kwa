<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VwUserTransaction extends Model
{
    use HasFactory;

    protected $table = 'vw_user_transaction';

    protected $primaryKey = 'sub_transactions_id';
}
