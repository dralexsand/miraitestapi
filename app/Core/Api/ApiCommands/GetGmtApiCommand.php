<?php

declare(strict_types=1);


namespace App\Core\Api\ApiCommands;

use App\Core\Api\ApiCore;
use App\Core\Api\CurlRequest;

class GetGmtApiCommand extends ApiCore
{
    protected function doProcess(array $request)
    {
        $id = $request['id'];
        $utc = $request['utc'];
        return $this->getRequest($id, $utc);
    }

    protected function requiredParams(): array
    {
        return ['id', 'utc'];
    }

    public function getRequest(string $id, string $utc)
    {
        $city = $this->cityService->getCityById($id);

        /*$city['original_name'] = $this
            ->cityService
            ->getCityNameFromMapById($id);

        $city['code_country'] = $this
            ->cityService
            ->convertIso3ToCountryCode($city['country_iso3']);*/

        $methodData = $this->apiTzMethodsCollect()['GET_TIMEZONE'];
        $url = $methodData['url'];
        $params = $methodData['params'];

        $params['lat'] = $city['latitude'];
        $params['lng'] = $city['longitude'];

        $curl = new CurlRequest();
        $response = $curl->curlGet($url, $params);
        return json_decode($response, true);
    }
}
