<?php

declare(strict_types=1);


namespace App\Services;

use App\Core\Database\DB;
use App\Models\City;

class CityService
{

    protected City $model;
    protected \PDO $db;

    public function __construct()
    {
        $this->model = new City();
        $this->db = DB::getInstance();
        \App\Core\Database\DB::setCharsetEncoding();
    }

    public function getAll()
    {
        try {
            $sqlExample = 'SELECT * FROM city LIMIT 1';
            $stm = $this->db->query($sqlExample);
            return $stm->fetchAll(\PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

}
