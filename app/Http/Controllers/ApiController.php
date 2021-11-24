<?php

declare(strict_types=1);


namespace App\Http\Controllers;

use App\Core\ApiCore;
use App\Services\CityService;
use Illuminate\Http\JsonResponse;
use F9Web\ApiResponseHelpers;

class ApiController extends ApiCore
{

    use ApiResponseHelpers;

    public string $apiName = 'city';
    protected CityService $cityService;

    public function __construct()
    {
        parent::__construct();
        $this->cityService = new CityService();
    }

    protected function indexAction(): JsonResponse
    {
        $cities = $this->cityService->getAll();

        if ($cities) {
            $list = collect($cities);
            $listResponse = $this->respondWithSuccess($cities);
            echo $listResponse;
            //$this->response($cities, 200);
        }
        return $this->respondError('Data not found');
        //$this->response('Data not found', 404);
    }

    protected function viewAction()
    {
        // TODO: Implement viewAction() method.
    }

    protected function createAction()
    {
        // TODO: Implement createAction() method.
    }

    protected function updateAction()
    {
        // TODO: Implement updateAction() method.
    }

    protected function deleteAction()
    {
        // TODO: Implement deleteAction() method.
    }
}
