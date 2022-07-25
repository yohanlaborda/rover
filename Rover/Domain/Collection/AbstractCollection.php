<?php

namespace Rover\Domain\Collection;

use ArrayObject;
use InvalidArgumentException;

abstract class AbstractCollection extends ArrayObject
{
    public function append($value): void
    {
        $this->validateInstanceOf($value);

        parent::append($value);
    }

    public function offsetSet($key, $value): void
    {
        $this->validateInstanceOf($value);

        parent::offsetSet($key, $value);
    }

    abstract protected function className(): string;

    abstract protected function validate($value): bool;

    private function validateInstanceOf(mixed $value): void
    {
        if (false === $this->validate($value)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Object must be an instance of %s',
                    $this->className()
                )
            );
        }
    }
}
