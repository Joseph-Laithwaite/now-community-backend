<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $fillable = [
        'name', 'url','imageable_type','imageable_id','size','description','type','user_id'
    ];

    protected $with = ['user:id,first_name,last_name,username'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }
}
