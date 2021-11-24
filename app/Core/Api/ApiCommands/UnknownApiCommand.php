<?php

declare(strict_types=1);


namespace App\Core\Api\ApiCommands;

use App\Core\Api\ApiCore;
use App\Core\Api\BadRequest;

class UnknownApiCommand extends ApiCore
{

    /**
     * @param array $request
     * @throws BadRequest
     */
    public function doProcess(array $request): BadRequest
    {
        throw new BadRequest('Неизвестный запрос');
    }

    protected function getRequest(string $id, string $param)
    {
        // TODO: Implement getRequest() method.
    }
}
