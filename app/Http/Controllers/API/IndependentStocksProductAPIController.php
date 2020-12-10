<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateIndependentStocksProductAPIRequest;
use App\Http\Requests\API\UpdateIndependentStocksProductAPIRequest;
use App\Models\IndependentStocksProduct;
use App\Repositories\IndependentStocksProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class IndependentStocksProductController
 * @package App\Http\Controllers\API
 */

class IndependentStocksProductAPIController extends AppBaseController
{
    /** @var  IndependentStocksProductRepository */
    private $independentStocksProductRepository;

    public function __construct(IndependentStocksProductRepository $independentStocksProductRepo)
    {
        $this->independentStocksProductRepository = $independentStocksProductRepo;
    }

    /**
     * Display a listing of the IndependentStocksProduct.
     * GET|HEAD /independentStocksProducts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $independentStocksProducts = $this->independentStocksProductRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($independentStocksProducts->toArray(), 'Independent Stocks Products retrieved successfully');
    }

    /**
     * Store a newly created IndependentStocksProduct in storage.
     * POST /independentStocksProducts
     *
     * @param CreateIndependentStocksProductAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateIndependentStocksProductAPIRequest $request)
    {
        $input = $request->all();

        $independentStocksProduct = $this->independentStocksProductRepository->create($input);

        return $this->sendResponse($independentStocksProduct->toArray(), 'Independent Stocks Product saved successfully');
    }

    /**
     * Display the specified IndependentStocksProduct.
     * GET|HEAD /independentStocksProducts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var IndependentStocksProduct $independentStocksProduct */
        $independentStocksProduct = $this->independentStocksProductRepository->find($id);

        if (empty($independentStocksProduct)) {
            return $this->sendError('Independent Stocks Product not found');
        }

        return $this->sendResponse($independentStocksProduct->toArray(), 'Independent Stocks Product retrieved successfully');
    }

    /**
     * Update the specified IndependentStocksProduct in storage.
     * PUT/PATCH /independentStocksProducts/{id}
     *
     * @param int $id
     * @param UpdateIndependentStocksProductAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIndependentStocksProductAPIRequest $request)
    {
        $input = $request->all();

        /** @var IndependentStocksProduct $independentStocksProduct */
        $independentStocksProduct = $this->independentStocksProductRepository->find($id);

        if (empty($independentStocksProduct)) {
            return $this->sendError('Independent Stocks Product not found');
        }

        $independentStocksProduct = $this->independentStocksProductRepository->update($input, $id);

        return $this->sendResponse($independentStocksProduct->toArray(), 'IndependentStocksProduct updated successfully');
    }

    /**
     * Remove the specified IndependentStocksProduct from storage.
     * DELETE /independentStocksProducts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var IndependentStocksProduct $independentStocksProduct */
        $independentStocksProduct = $this->independentStocksProductRepository->find($id);

        if (empty($independentStocksProduct)) {
            return $this->sendError('Independent Stocks Product not found');
        }

        $independentStocksProduct->delete();

        return $this->sendSuccess('Independent Stocks Product deleted successfully');
    }
}
