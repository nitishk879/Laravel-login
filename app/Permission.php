<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;
    protected $fillable = array('name', 'title');

    public function role(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
