<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

$absolutePathToEnvFile = __DIR__ . '/../.env';
(new \App\Helpers\DotEnvReader($absolutePathToEnvFile))->load();

$api = new \App\Core\Api\ApiEntry();
$api->run();

