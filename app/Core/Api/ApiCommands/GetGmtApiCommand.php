<?php

declare(strict_types=1);


namespace App\Core\Api\ApiCommands;

use App\Core\Api\ApiCore;

class GetGmtApiCommand extends ApiCore
{

    protected function doProcess(array $request)
    {
        // TODO SQL request

        $data = [
            'action' => 'GetGmtApiCommand',
            'request' => $request,
        ];

        return $data;
    }

    protected function requiredParams(): array
    {
        return ['id', 'utc'];
    }
}
