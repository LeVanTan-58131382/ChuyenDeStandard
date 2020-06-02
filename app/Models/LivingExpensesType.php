<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivingExpensesType extends Model
{
    public $table = 'living_expenses_types';

    protected $fillable = [
        'name',
    ];
}
