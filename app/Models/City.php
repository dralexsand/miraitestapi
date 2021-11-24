<?php

declare(strict_types=1);


namespace App\Models;

class City
{

    protected $table = 'city';

    protected string $id;
    protected string $country_iso3;
    protected string $name;
    protected float $latitude;
    protected float $longitude;



}
