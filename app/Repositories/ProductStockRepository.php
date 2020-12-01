<?php

namespace App\Repositories;

use App\Models\ProductStock;
use App\Repositories\BaseRepository;

/**
 * Class ProductStockRepository
 * @package App\Repositories
 * @version November 23, 2020, 12:07 pm UTC
*/

class ProductStockRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'independent_id',
        'product_id',
        'manage_stock',
        'stock_level',
        'date_in_stock',
        'expriy_date',
        'batch_id',
        'location_id'
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
        return ProductStock::class;
    }
}
