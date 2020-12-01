<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPermission extends Pivot
{
    use HasFactory;

    public function user(){
    	return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function permission(){
    	return $this->hasOne('App\Models\Permission', 'id', 'permission_id');
    }

    public function independent(){
    	return $this->hasOne('App\Models\Independent', 'id', 'independent_id');
    }
}
 