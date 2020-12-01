<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductStockAPIRequest;
use App\Http\Requests\API\UpdateProductStockAPIRequest;
use App\Models\ProductStock;
use App\Repositories\ProductStockRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductStockController
 * @package App\Http\Controllers\API
 */

class ProductStockAPIController extends AppBaseController
{
    /** @var  ProductStockRepository */
    private $productStockRepository;

    public function __construct(ProductStockRepository $productStockRepo)
    {
        $this->productStockRepository = $productStockRepo;
    }

    /**
     * Display a listing of the ProductStock.
     * GET|HEAD /productStocks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $productStocks = $this->productStockRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($productStocks->toArray(), 'Product Stocks retrieved successfully');
    }

    public function indexIndependentProducts($independent_id, Request $request)
    {
        $productStocks = ProductStock::
                            with('product')
                            ->where('independent_id','=',$independent_id)
                            ->where('archived','=','0')
                            ->where(function($query) {
                                $query
                                    ->where('expriy_date', '>=', date("Y-m-d").'T'.date("H:m:s").'.000000Z')
                                    ->orWhere('expriy_date', null);
                            })
                            ->get();
        $productStocks = $productStocks->groupBy('product_id');
        return $this->sendResponse($productStocks->toArray(), 'Product Stocks retrieved successfully');
    }

    /**
     * Store a newly created ProductStock in storage.
     * POST /productStocks
     *
     * @param CreateProductStockAPIRequest $request
     *
     * @return Response
     */

    public function store(CreateProductStockAPIRequest $request)
    {
        $input = $request->all();

        $productStock = $this->productStockRepository->create($input);

        return $this->sendResponse($productStock->toArray(), 'Product Stock saved successfully');
    }


    public function storeIndependentProduct(CreateProductStockAPIRequest $request)
    {
        $input = $request->all();

        $productStock = $this->productStockRepository->create($input);

        return $this->sendResponse($productStock->toArray(), 'Product Stock saved successfully');
    }

    /**
     * Display the specified ProductStock.
     * GET|HEAD /productStocks/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ProductStock $productStock */
        $productStock = $this->productStockRepository->find($id);

        if (empty($productStock)) {
            return $this->sendError('Product Stock not found');
        }

        return $this->sendResponse($productStock->toArray(), 'Product Stock retrieved successfully');
    }


    /**
     * Update the specified ProductStock in storage.
     * PUT/PATCH /productStocks/{id}
     *
     * @param int $id
     * @param UpdateProductStockAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductStockAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProductStock $productStock */
        $productStock = $this->productStockRepository->find($id);

        if (empty($productStock)) {
            return $this->sendError('Product Stock not found');
        }

        $productStock = $this->productStockRepository->update($input, $id);

        return $this->sendResponse($productStock->toArray(), 'ProductStock updated successfully');
    }

    /**
     * Remove the specified ProductStock from storage.
     * DELETE /productStocks/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ProductStock $productStock */
        $productStock = $this->productStockRepository->find($id);

        if (empty($productStock)) {
            return $this->sendError('Product Stock not found');
        }

        $productStock->delete();

        return $this->sendSuccess('Product Stock deleted successfully');
    }
}
