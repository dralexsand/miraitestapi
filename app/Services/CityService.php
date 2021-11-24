<?php

declare(strict_types=1);


namespace App\Services;

use App\Core\Database\DB;

class CityService
{
    protected \PDO $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
        \App\Core\Database\DB::setCharsetEncoding();
    }

    public function getCityById(string $id)
    {
        $sql = "SELECT * FROM city WHERE id=:id LIMIT 1";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            $city = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            print $e->getMessage();
        }

        return $city[0];
    }

    public function apiTzMethodsCollect(): array
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
