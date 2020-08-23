<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $fillable = array('name', 'title');

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function assignPermission($permission){

        if(is_string($permission)){
            $permission = Permission::where('name', $permission)->findOrFail();
        }

        return $this->permissions()->sync($permission,false);
    }
}
