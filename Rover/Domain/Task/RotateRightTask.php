<?php

namespace Rover\Domain\Task;

use Rover\Domain\ValueObject\Direction;

final class RotateRightTask extends AbstractRotateTask
{
    public function abbreviation(): string
    {
        return 'R';
    }

    protected function rotate(Direction $direction): Direction
    {
        if ($direction->isOrientationNorth()) {
            return Direction::east();
        }

        if ($direction->isOrientationEast()) {
            return Direction::south();
        }

        if ($direction->isOrientationSouth()) {
            return Direction::west();
        }

        if ($direction->isOrientationWest()) {
            return Direction::north();
        }
    }
}
