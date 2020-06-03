<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemCalendar extends Model
{
    protected $table = 'system_calendars';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'month', 'year'
    ];
}
