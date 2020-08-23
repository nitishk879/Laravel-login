<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'phone', 'avatar',
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
    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function hasRole($role){
        return $this->roles()->where('name', '=', $role);
    }

    public function isAdmin(){
        if($this->roles()->where('name', '=', 'admin')->first()){
            return true;
        }

        return false;
    }

    public function assignRole($role){
        if(is_string($role)){
            $role = Role::where('name', $role)->findOrFail();
        }

        return $this->roles()->sync($role, false);
    }

    public function permissions(){

        return $this->roles->map->permissions->flatten()->pluck('name')->unique();
    }

    public function routeNotificationForNexmo($notification)
    {
        return '916230030003';  //$this->phone;
    }
}
