<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockist extends Model
{
    use HasFactory;

    public function stockistable(){
    	return $this->morphTo();
    }

    public function stockists()
    {
        return $this->morphMany(Stockist::class, 'stockistable');
    }
}
