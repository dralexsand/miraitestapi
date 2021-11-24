<?php

declare(strict_types=1);


namespace App\Helpers\DotEnvProcess;

class QuotedProcess extends AbstractProcess
{

    public function canBeProcessed(): bool
    {
        $wrappedByDoubleQuotes = $this->isWrappedByChar($this->value, '"');

        if ($wrappedByDoubleQuotes) {
            return true;
        }

        return $this->isWrappedByChar($this->value, '\'');
    }

    public function execute(): string
    {
        /**
         * Since this function is used for the quote removal
         * we don't need mb_substr
         */
        return substr($this->value, 1, -1);
    }

    private function isWrappedByChar(string $value, string $char): bool
    {
        return !empty($value) && $value[0] === $char && $value[-1] === $char;
    }
}
