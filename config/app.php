<?php

return [
    'deploy' => getenv('DEPLOY', 'local'),
    'debug' => getenv('DEBUG', true),
    'app_name' => getenv('APP_NAME', 'Mirai Test'),
    'logs' => getenv('APP_ROOT').env('LOGS'),
];
