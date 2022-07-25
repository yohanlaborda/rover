<?php

namespace Rover\Domain\Collection;

use Rover\Domain\ValueObject\Position;

class PositionCollection extends AbstractCollection
{
    public function __construct(Position ...$positions)
    {
        parent::__construct($positions);
    }

    protected function className(): string
    {
        return Position::class;
    }

    protected function validate($value): bool
    {
        return $value instanceof Position;
    }
}
