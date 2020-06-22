<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Message extends Model 
{
    public $table = 'messages';

    protected $fillable = [
        'user_id_from',
        'user_id_to',
        'title',
        'content',
        'read_customer',
        'read_admin',
        'deleted',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function userFrom() {
        return $this->belongsTo(Customer::class, 'user_id_from');
    }

    public function userTo() {
        return $this->belongsTo(Customer::class, 'user_id_to');
    }

    public function scopeNotDeleted($query) {
        return $query->where('deleted', false);
    }

    public function scopeDeleted($query) {
        return $query->where('deleted', true);
    }
}
