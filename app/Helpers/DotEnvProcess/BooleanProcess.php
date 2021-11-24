<?php

declare(strict_types=1);


namespace App\Helpers\DotEnvProcess;

class BooleanProcess extends AbstractProcess
{

    public function canBeProcessed(): bool
    {
        $loweredValue = strtolower($this->value);
        return in_array($loweredValue, ['true', 'false'], true);
    }

    public function execute(): bool
    {
        return strtolower($this->value) === 'true';
    }
}
