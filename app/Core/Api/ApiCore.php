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
    protected array $apiTzMethods;
    protected CityService $cityService;

    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->apiTzMethods = $this->apiTzMethodsCollect();
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

    protected function apiTzMethodsCollect(): array
    {
        return [
            'GET_LIST' => [
                'url' =>
                    getenv('TIMEZONE_DB_API_ENTRY')
                    . getenv('TIMEZONE_DB_API_GET_LIST'),
                'params' => [
                    'key' => getenv('TIMEZONE_DB_API_KEY'),
                    'format' => 'json',
                ],
            ],
            'GET_TIMEZONE' => [
                'url' => getenv('TIMEZONE_DB_API_ENTRY')
                    . getenv('TIMEZONE_DB_API_GET_TIMEZONE'),
                'params' => [
                    'key' => getenv('TIMEZONE_DB_API_KEY'),
                    'format' => 'json',
                    'by' => 'position',
                    'lat' => '', // Get from DB
                    'lng' => '', // Get from DB
                ],
            ],
            'CONVERT_TIMEZONE' => [
                'url' => getenv('TIMEZONE_DB_API_ENTRY')
                    . getenv('TIMEZONE_DB_API_CONVERT_TIMEZONE'),
                'params' => [
                    'key' => getenv('TIMEZONE_DB_API_KEY'),
                    'format' => 'json',
                    'from' => '', // A valid abbreviation or name of time zone
                    'to' => '', // A valid abbreviation or name of time zone
                ],
            ],
        ];
    }

}
