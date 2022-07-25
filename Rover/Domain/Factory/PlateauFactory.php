<?php

namespace Rover\Domain\Factory;

use Rover\Domain\Entity\Plateau;
use Rover\Domain\ValueObject\Coordinate;
use Rover\Domain\ValueObject\Id;

class PlateauFactory
{
    public function create(int $x, int $y): Plateau
    {
        return new Plateau(
            Id::create(),
            Coordinate::fromString($x, $y)
        );
    }
}
