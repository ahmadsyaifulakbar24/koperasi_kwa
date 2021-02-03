<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSetting extends Model
{
    use HasFactory;
    protected $table = 'main_settings';

    protected $fillable = [
        'name_setting',
        'value',
    ];

    public $timestamps = false;
}
