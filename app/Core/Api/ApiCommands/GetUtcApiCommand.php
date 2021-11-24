<?php

declare(strict_types=1);


namespace App\Core\Api\ApiCommands;

use App\Core\Api\ApiCore;

class GetUtcApiCommand extends ApiCore
{

    public function doProcess(array $request)
    {
        // TODO SQL request

        $data = [
            'action' => 'GetUtcApiCommand',
            'request' => $request,
        ];

        return $data;

    }

    protected function requiredParams(): array
    {
        return ['id', 'gmt'];
    }
}
