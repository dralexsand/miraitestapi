<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

(new \App\Helpers\DotEnvReader(__DIR__ . '/../.env'))->load();

$api = new \App\Core\Api\ApiEntry();
$api->run();

