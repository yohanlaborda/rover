<?php

namespace tests\Rover\Unit\Domain\Collection;

use Rover\Domain\Collection\PositionCollection;
use Rover\Domain\ValueObject\Coordinate;
use Rover\Domain\ValueObject\Direction;
use Rover\Domain\ValueObject\Position;

final class PositionCollectionTest extends AbstractCollectionTest
{
    protected function className(): string
    {
        return PositionCollection::class;
    }

    protected function object(): object
    {
        return Position::from(Coordinate::fromString('1', '10'), Direction::north());
    }

    protected function objectClassName(): string
    {
        return Position::class;
    }
}
