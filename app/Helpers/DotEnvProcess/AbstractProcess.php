<?php

declare(strict_types=1);


namespace App\Helpers\DotEnvProcess;

abstract class AbstractProcess implements IProcess
{
    /**
     * The value to process
     * @var string
     */
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
