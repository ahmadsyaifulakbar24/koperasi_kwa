<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKoperasiDetail extends Model
{
    use HasFactory;

    protected $table = 'user_koperasi_details';

    protected $fillable = [
        'user_id',
        'status_keluarga_id',
        'nama_ahliwaris',
        'besar_simpanan_wajib',
        'upload_ktp',
        'saldo_simpanan',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function status_keluarga()
    {
        return $this->belongsTo(Param::class, 'status_keluarga_id');
    }
}
