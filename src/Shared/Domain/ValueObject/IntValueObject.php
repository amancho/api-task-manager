<?php

namespace Tappx\Tasks\Shared\Domain\ValueObject;

abstract class IntValueObject
{
    protected int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function isBiggerThan(IntValueObject $other): bool
    {
        return $this->value() > $other->value();
    }

    public function value(): int
    {
        return $this->value;
    }
}