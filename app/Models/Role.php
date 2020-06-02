<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['id', 'name', 'description'];
	public function users()
	{
		return $this->belongsToMany(User::class);
	}
}
