<?php

namespace App\Helpers\DotEnvProcess;

interface IProcess
{
    public function __construct(string $value);

    public function canBeProcessed(): bool;

    public function execute();
}
