<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $table = 'setting_indexs';

    protected $fillable = [
        'highest_number_of_cars',
        'highest_number_of_motos',
        'highest_number_of_bikes',
        
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
