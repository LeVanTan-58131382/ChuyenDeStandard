<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsumptionIndex extends Model
{
    protected $table = 'consumption_indexs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'living_expenses_type_id', 'month_consumption', 'last_month_index', 'this_month_index'
    ];
}
