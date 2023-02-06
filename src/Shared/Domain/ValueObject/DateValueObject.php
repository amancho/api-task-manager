<?php

namespace Tappx\Tasks\Shared\Domain\ValueObject;

abstract class DateValueObject
{
    protected const DEFAULT_DATE_TIME_FORMAT = 'Y-m-d H:i:s';
    protected string $value;

    public function __construct(string $value)
    {
        if (!$this->isValid($value)) {
            $value = '';
        }

        $this->value = $value;
    }

    public function isValid(string $value): bool
    {
        $pattern = '/^[0-9]{4}(-|\/)([1-9]|0[1-9]|1[0-2])(-|\/)([1-9]|0[1-9]|[1-2][0-9]|3[0-1])\s(0|[0-1][0-9]|2[0-4]):?((0|[0-5][0-9]):?(0|[0-5][0-9])|6000|60:00)$/';

        if (\preg_match($pattern, $value)) {
            return true;
        }
            return false;
    }

    public function value(): string
    {
        return $this->value;
    }
}