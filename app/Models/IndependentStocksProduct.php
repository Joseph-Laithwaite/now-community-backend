<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class IndependentStocksProduct
 * @package App\Models
 * @version December 4, 2020, 3:44 pm UTC
 *
 * @property \App\Models\Product $product
 * @property \App\Models\Independent $independent
 * @property \App\Models\Location $location
 * @property integer $product_id
 * @property boolean $archived
 * @property integer $independent_id
 * @property integer $location_id
 * @property boolean $manage_stock
 * @property number $restock_level
 * @property boolean $auto_restock
 * @property boolean $wholesale
 * @property boolean $is_packaging
 * @property number $restock_quanity
 * @property string $restock_frequency
 * @property integer $single_product_decimals
 * @property string $single_product_unit
 * @property boolean $in_stock
 */
class IndependentStocksProduct extends Model
{

    public $table = 'independent_stocks_product';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'product_id',
        'archived',
        'independent_id',
        'location_id',
        'manage_stock',
        'restock_level',
        'auto_restock',
        'wholesale',
        'is_packaging',
        'restock_quanity',
        'restock_frequency',
        'single_product_decimals',
        'single_product_unit',
        'in_stock'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'archived' => 'boolean',
        'independent_id' => 'integer',
        'location_id' => 'integer',
        'manage_stock' => 'boolean',
        'restock_level' => 'float',
        'auto_restock' => 'boolean',
        'wholesale' => 'boolean',
        'is_packaging' => 'boolean',
        'restock_quanity' => 'float',
        'restock_frequency' => 'string',
        'single_product_decimals' => 'integer',
        'single_product_unit' => 'string',
        'in_stock' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'product_id' => 'required',
        'archived' => 'nullable|boolean',
        'independent_id' => 'required',
        'location_id' => 'nullable',
        'manage_stock' => 'nullable|boolean',
        'restock_level' => 'nullable|numeric',
        'auto_restock' => 'nullable|boolean',
        'wholesale' => 'nullable|boolean',
        'is_packaging' => 'nullable|boolean',
        'restock_quanity' => 'nullable|numeric',
        'restock_frequency' => 'nullable|string|max:50',
        'single_product_decimals' => 'nullable|integer',
        'single_product_unit' => 'nullable|string|max:10',
        'in_stock' => 'nullable|boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function independent()
    {
        return $this->belongsTo(\App\Models\Independent::class, 'independent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function location()
    {
        return $this->belongsTo(\App\Models\Location::class, 'location_id');
    }
}
