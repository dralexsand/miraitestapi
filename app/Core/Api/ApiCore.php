<?php

declare(strict_types=1);


namespace App\Core\Api;

use App\Core\Api\ApiCommands\GetGmtApiCommand;
use App\Core\Api\ApiCommands\GetUtcApiCommand;
use App\Core\Api\ApiCommands\UnknownApiCommand;
use App\Core\Api\BadRequest;
use App\Core\Api\ProcessingError;
use App\Core\Database\DB;
use App\Services\CityService;

abstract class ApiCore
{
    protected \PDO $db;

    protected CityService $cityService;

    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->cityService = new CityService();
    }

    public static function get(string $action): ApiCore
    {
        switch ($action) {
            case 'gmt':
                return new GetGmtApiCommand();
            case 'utc':
                return new GetUtcApiCommand();
            default:
                return new UnknownApiCommand();
        }
    }

    public function process(array $request)
    {
        $required = $this->requiredParams();

        foreach ($required as $paramName) {
            if (empty($request[$paramName])) {
                throw new BadRequest("Не указан параметр $paramName");
            }
        }

        return $this->doProcess($request);
    }

    protected function requiredParams(): array
    {
        return [];
    }

    abstract protected function doProcess(array $request);

    abstract protected function getRequest(string $id, string $param);

}
