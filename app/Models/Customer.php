<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ApartmentAddress;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Notification;

class Customer extends Model
{
    public $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'date_of_birth',
        'gender',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function create(Request $request){
        $customer = new Customer();
        $customer -> name = $request -> name;
        $customer -> email = $request -> email;
        // phần sinh password tự động 
        $customer -> password = 'aa';
        $customer -> phone = $request -> phone;
    }

    public function apartmentAddress()
    {
        return $this->hasOne(ApartmentAddress::class, 'customer_id', 'id');
    }

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class, 'customer_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'customer_id', 'id');
    }

    public function notifications() // tên table
    {
        return $this->belongsToMany(Notification::class);
    }
}
