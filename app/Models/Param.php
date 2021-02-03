<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Param extends Model
{
    use HasFactory;

    protected $table = 'params';

    protected $fillable = [
        'param_id',
        'category_param',
        'param',
        'order',
        'active',
    ];

    public $timestamps = false;

    public function user_pendidikan() 
    {
        $this->hasMany(User::class, 'pendidikan_id');
    }

    public function user_jabatan() 
    {
        $this->hasMany(User::class, 'jabatan_id');
    }

    public function user_status_keluarga() 
    {
        $this->hasMany(UserKoperasiDetail::class, 'status_keluarga_id');
    }
}
