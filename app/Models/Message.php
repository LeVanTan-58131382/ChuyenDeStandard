<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Message extends Model
{
    public function userFrom() {
        return $this->belongsTo(Customer::class, 'customer_id_from');
    }

    public function userTo() {
        return $this->belongsTo(Customer::class, 'customer_id_to');
    }

    public function scopeNotDeleted($query) {
        return $query->where('deleted', false);
    }

    public function scopeDeleted($query) {
        return $query->where('deleted', true);
    }
}
