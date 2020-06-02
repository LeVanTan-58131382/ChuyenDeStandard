<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\VehicleUser;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function addUser(UserRequest $urequest, Request $request){
        $user = new User();
        $user -> name = $urequest -> name;
        $user -> email = $urequest -> email;
        $user -> password = Hash::make($urequest -> password);
        $user -> phone = $urequest -> phone;
        $user
       ->roles()
       ->attach(Role::where('name', 'employee')->first());
        $user -> save();

        // add vehicle
        if($request -> car){
            $vehicle_car = new VehicleUser;
            $vehicle_car -> vehicle_type_id = 1;
            $vehicle_car -> living_expenses_type_id = 3;
            $vehicle_car -> user_id = $user -> id;
            $vehicle_car -> amount = $request -> car;
            $vehicle_car -> save();
        }
        if($request -> moto){
            $vehicle_moto = new VehicleUser;
            $vehicle_moto -> vehicle_type_id = 2;
            $vehicle_moto -> living_expenses_type_id = 3;
            $vehicle_moto -> user_id = $user -> id;
            $vehicle_moto -> amount = $request -> moto;
            $vehicle_moto -> save();
        }
        if($request -> bike){
            $vehicle_bike = new VehicleUser;
            $vehicle_bike -> vehicle_type_id = 3;
            $vehicle_bike -> living_expenses_type_id = 3;
            $vehicle_bike -> user_id = $user -> id;
            $vehicle_bike -> amount = $request -> bike;
            $vehicle_bike -> save();
        }

    }

    public function apartment() {
        return $this->hasOne('App\Models\ApartmentAddress');
    }

    public function vehicle() {
        return $this->hasMany('App\Models\VehicleUser');
    }

    public function roles()
    {
      return $this->belongsToMany(Role::class);
    }

    /**
* @param string|array $roles
*/
    public function authorizeRoles($roles)
    {
      if (is_array($roles)) {
          return $this->hasAnyRole($roles) || 
          abort(401, 'This action is unauthorized.');
      }
      return $this->hasRole($roles) || 
      abort(401, 'This action is unauthorized.');
    }
    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
      return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
      return null !== $this->roles()->where('name', $role)->first();
    }
}
