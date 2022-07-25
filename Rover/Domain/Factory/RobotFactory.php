<?php

namespace Rover\Domain\Factory;

use Rover\Domain\Entity\Plateau;
use Rover\Domain\Entity\Robot;
use Rover\Domain\ValueObject\Coordinate;
use Rover\Domain\ValueObject\Direction;
use Rover\Domain\ValueObject\Id;

class RobotFactory
{
    public function create(
        Plateau $plateau,
        int $x,
        int $y,
        string $orientation
    ) {
        return new Robot(
            Id::create(),
            $plateau,
            Coordinate::fromString($x, $y),
            Direction::fromString($orientation)
        );
    }
}
