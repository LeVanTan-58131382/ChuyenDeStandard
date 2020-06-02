<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Notification extends Model
{
    public $table = 'notifications';

    protected $fillable = [
        'title',
        'content',
        'scope',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function customers() // tên table
    {
        return $this->belongsToMany(Customer::class);
    }
}
 