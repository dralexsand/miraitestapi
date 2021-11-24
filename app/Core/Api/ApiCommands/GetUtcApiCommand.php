<?php

declare(strict_types=1);


namespace App\Core\Api\ApiCommands;

use App\Core\Api\ApiCore;
use App\Core\Api\CurlRequest;

class GetUtcApiCommand extends ApiCore
{

    public function doProcess(array $request)
    {
        $id = $request['id'];
        $gmt = $request['gmt'];
        return $this->getRequest($id, $gmt);

    }

    protected function requiredParams(): array
    {
        return ['id', 'gmt'];
    }

    public function getRequest(string $id, string $gmt)
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
