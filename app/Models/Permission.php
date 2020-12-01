<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Permission extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function users(){
    	return $this->belongsToMany('App\Models\User')->using('App\Models\UserPermission');
    }
    public function independents(){
    	return $this->belongsToMany('App\Models\Independent')->using('App\Models\UserPermission');
    }
}
