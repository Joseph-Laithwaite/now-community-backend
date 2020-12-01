<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ProductStock
 * @package App\Models
 * @version November 23, 2020, 12:07 pm UTC
 *
 * @property \App\Models\Independent $independent
 * @property \App\Models\Product $product
 * @property \App\Models\ProductBatch $batch
 * @property \App\Models\Location $location
 * @property integer $independent_id
 * @property integer $product_id
 * @property boolean $manage_stock
 * @property integer $stock_level
 * @property string|\Carbon\Carbon $date_in_stock
 * @property string|\Carbon\Carbon $expriy_date
 * @property integer $batch_id
 * @property integer $location_id
 */
class ProductStock extends Model
{

    public $table = 'product_stock';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'independent_id',
        'product_id',
        'manage_stock',
        'stock_level',
        'date_in_stock',
        'expriy_date',
        'batch_id',
        'location_id',
        'archived'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'independent_id' => 'integer',
        'product_id' => 'integer',
        'manage_stock' => 'boolean',
        'stock_level' => 'integer',
        'date_in_stock' => 'datetime',
        'expriy_date' => 'datetime',
        'batch_id' => 'integer',
        'location_id' => 'integer',
        'archived' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'updated_at' => 'nullable',
        'created_at' => 'nullable',
        'independent_id' => 'required',
        'product_id' => 'required',
        'manage_stock' => 'required|boolean',
        'stock_level' => 'required',
        'date_in_stock' => 'nullable',
        'expriy_date' => 'nullable',
        'batch_id' => 'nullable',
        'location_id' => 'nullable',
        'archived' => 'nullable|boolean',
    ];

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
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function batch()
    {
        return $this->belongsTo(\App\Models\ProductBatch::class, 'batch_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function location()
    {
        return $this->belongsTo(\App\Models\Location::class, 'location_id');
    }
}
