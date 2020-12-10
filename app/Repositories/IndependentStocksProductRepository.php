<?php

namespace App\Repositories;

use App\Models\IndependentStocksProduct;
use App\Repositories\BaseRepository;

/**
 * Class IndependentStocksProductRepository
 * @package App\Repositories
 * @version December 4, 2020, 3:44 pm UTC
*/

class IndependentStocksProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return IndependentStocksProduct::class;
    }
}
