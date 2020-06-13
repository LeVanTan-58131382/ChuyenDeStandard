<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Bill;

class Comment extends Model
{
    protected $table = 'comments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
        'customer_id', 
        'title', 
        'content', 
        'bill_id', 
        'read', 
        'deleted', 
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function bills()
    {
        return $this->belongsTo(Bill::class, 'customer_id');
    }
}
