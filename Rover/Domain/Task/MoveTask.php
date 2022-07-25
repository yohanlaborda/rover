<?php

namespace Rover\Domain\Task;

use Rover\Domain\Entity\Robot;
use Rover\Domain\ValueObject\Coordinate;
use Rover\Domain\ValueObject\Direction;

final class MoveTask implements TaskInterface
{
    public function abbreviation(): string
    {
        return 'M';
    }

    public function execute(Robot $robot): void
    {
        $robot->setCoordinate(
            $this->getCoordinate($robot->direction(), $robot->coordinate())
        );
    }

    private function getCoordinate(Direction $direction, Coordinate $coordinate): Coordinate
    {
        if ($direction->isOrientationNorth()) {
            return $coordinate->addOneToY();
        }

        if ($direction->isOrientationWest()) {
            return $coordinate->subtractOneToX();
        }

        if ($direction->isOrientationEast()) {
            return $coordinate->addOneToX();
        }

        if ($direction->isOrientationSouth()) {
            return $coordinate->subtractOneToY();
        }
    }
}
