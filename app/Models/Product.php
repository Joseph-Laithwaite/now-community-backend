<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;



/**
 * Class Product
 * @package App\Models
 * @version October 22, 2020, 3:09 pm UTC
 *
 * @property \App\Models\Brand $brand
 * @property \App\Models\Location $location
 * @property \Illuminate\Database\Eloquent\Collection $components
 * @property \Illuminate\Database\Eloquent\Collection $component1s
 * @property \Illuminate\Database\Eloquent\Collection $wastes
 * @property \Illuminate\Database\Eloquent\Collection $waste2s
 * @property string $name
 * @property string $slug
 * @property number $price
 * @property number $vat
 * @property number $deposit
 * @property boolean $is_packaging
 * @property boolean $wholesale
 * @property boolean $public_purchase
 * @property integer $brand_id
 * @property integer $location_id
 */
class Product extends Model
{
    use hasFactory;

    public $table = 'products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    // protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'slug',
        'price',
        'vat',
        'deposit',
        'is_packaging',
        'wholesale',
        'public_purchase',
        'brand_id',
        'location_id'
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
        'price' => 'decimal:2',
        'vat' => 'decimal:2',
        'deposit' => 'decimal:2',
        'is_packaging' => 'boolean',
        'wholesale' => 'boolean',
        'public_purchase' => 'boolean',
        'brand_id' => 'integer',
        'location_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => ['required','string','max:255'],
        'slug' => ['required','string','max:255','unique:products'], 
        'price' => 'required|numeric',
        'vat' => 'nullable|numeric',
        'deposit' => 'numeric',
        'is_packaging' => 'boolean',
        'wholesale' => 'boolean',
        'public_purchase' => 'boolean',
        'brand_id' => 'required',
        'location_id' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class, 'brand_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function location()
    {
        return $this->belongsTo(\App\Models\Location::class, 'location_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function components()
    {
        return $this->hasMany(\App\Models\Component::class, 'component_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function component1s()
    {
        return $this->hasMany(\App\Models\Component::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function wastes()
    {
        return $this->hasMany(\App\Models\Waste::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function waste2s()
    {
        return $this->hasMany(\App\Models\Waste::class, 'reuse_product_id');
    }
}
