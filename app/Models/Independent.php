<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Independent
 * @package App\Models
 * @version November 2, 2020, 10:55 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $brands
 * @property \Illuminate\Database\Eloquent\Collection $investors
 * @property \Illuminate\Database\Eloquent\Collection $investor1s
 * @property \Illuminate\Database\Eloquent\Collection $stores
 * @property \Illuminate\Database\Eloquent\Collection $userPermissions
 * @property \Illuminate\Database\Eloquent\Collection $wastes
 * @property string $name
 * @property string $slug
 * @property string $business_structure
 * @property string $email
 * @property string $profile_picture
 * @property string $cover_photo
 * @property string $about_us
 */
class Independent extends Model
{
    // use SoftDeletes;

    public $table = 'independents';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    // protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'slug',
        'business_structure',
        'email',
        'about_us',
        'profile_picture',
        'cover_photo',
        'logo',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'business_structure' => 'string',
        'email' => 'string',
        'about_us' => 'string',
        'profile_picture' => 'integer',
        'cover_photo' => 'integer',
        'logo' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'business_structure' => 'nullable|string',
        'email' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'about_us' => 'nullable|string',
        'profile_picture' => 'nullable|integer',
        'cover_photo' => 'nullable|integer',
        'logo' => 'nullable|integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     **/

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function brands()
    {
        return $this->hasMany(\App\Models\Brand::class, 'independent_id');
    }

    public function products()
    {
        return $this->belongsToMany('\App\Models\Product','independent_stocks_product');
    }
    public function productStock()
    {
        return $this->belongsToMany('\App\Models\Product','independent_stocks_product')
                    ->withPivot('id','manage_stock','date_in_stock','expriy_date','batch_id','location_id','independent_id','stock_level','archived','product_id')
                    ->as('stock')
                    ->withTimestamps()
                    ;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function investors()
    {
        return $this->hasMany(\App\Models\Investor::class, 'independent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function investor1s()
    {
        return $this->hasMany(\App\Models\Investor::class, 'investor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function stores()
    {
        return $this->hasMany(\App\Models\Store::class, 'independent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function userPermissions()
    {
        return $this->hasMany(\App\Models\UserPermission::class, 'independent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function wastes()
    {
        return $this->hasMany(\App\Models\Waste::class, 'recovery_facility_id');
    }
}
