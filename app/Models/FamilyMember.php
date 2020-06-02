<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class FamilyMember extends Model
{
    public $table = 'family_members';

    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}