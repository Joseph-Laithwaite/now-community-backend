<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateIndependentAPIRequest;
use App\Http\Requests\API\UpdateIndependentAPIRequest;
use App\Models\Independent;
use App\Repositories\IndependentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class IndependentController
 * @package App\Http\Controllers\API
 */

class IndependentAPIController extends AppBaseController
{
    /** @var  IndependentRepository */
    private $independentRepository;

    public function __construct(IndependentRepository $independentRepo)
    {
        $this->independentRepository = $independentRepo;
    }

    /**
     * Display a listing of the Independent.
     * GET|HEAD /independents
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $independents = $this->independentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($independents->toArray(), 'Independents retrieved successfully');
    }

    /**
     * Store a newly created Independent in storage.
     * POST /independents
     *
     * @param CreateIndependentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateIndependentAPIRequest $request)
    {
        $input = $request->all();

        $independent = $this->independentRepository->create($input);

        return $this->sendResponse($independent->toArray(), 'Independent saved successfully');
    }

    /**
     * Display the specified Independent.
     * GET|HEAD /independents/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Independent $independent */
        $independent = $this->independentRepository->find($id);

        if (empty($independent)) {
            return $this->sendError('Independent not found');
        }

        return $this->sendResponse($independent->toArray(), 'Independent retrieved successfully');
    }

    /**
     * Update the specified Independent in storage.
     * PUT/PATCH /independents/{id}
     *
     * @param int $id
     * @param UpdateIndependentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIndependentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Independent $independent */
        $independent = $this->independentRepository->find($id);

        if (empty($independent)) {
            return $this->sendError('Independent not found');
        }

        $independent = $this->independentRepository->update($input, $id);

        return $this->sendResponse($independent->toArray(), 'Independent updated successfully');
    }

    /**
     * Remove the specified Independent from storage.
     * DELETE /independents/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Independent $independent */
        $independent = $this->independentRepository->find($id);

        if (empty($independent)) {
            return $this->sendError('Independent not found');
        }

        $independent->delete();

        return $this->sendSuccess('Independent deleted successfully');
    }
}
