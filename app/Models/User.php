<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

use App\Models\UserPermission;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password',
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

    public function permissions(){
        return $this
                ->belongsToMany('App\Models\Permission', 'user_permission', 'user_id', 'permission_id')
                ->using('App\Models\UserPermission')
                ->withPivot(['independent_id']);
    }


    public function hasPermissionTo($permission, $independent) {
        if ($this->permissions->contains($permission)){
            if($this->independents->contains($independent)){
                return true;    
            }
        }
        return false;
    }

    public function givePermissionTo($permission, $independent) {
        if ($permission){
            if($independent){
                UserPermission::create([
                    'user_id' => $this->id,
                    'permission_id' => $permission, 
                    'independent_id' => $independent]);
                // $this->userPermission->create($permission, $independent);
                return $this->userPermission;    
            }
        }
        return false;
    }



    public function independents(){
        return $this
            ->belongsToMany('App\Models\Independent', 'user_permission', 'user_id', 'independent_id')
            ->using('App\Models\UserPermission')
            ->withPivot(['permission_id']);
    }

    public function userPermission(){
        return $this->hasMany('App\Models\UserPermission');
    }

    public function images(){
        return $this->hasMany('App\Models\Image');
    }
}
