<?php

namespace Rover\Domain\Task;

use Rover\Domain\ValueObject\Direction;

final class RotateLeftTask extends AbstractRotateTask
{
    public function abbreviation(): string
    {
        return 'L';
    }

    protected function rotate(Direction $direction): Direction
    {
        if ($direction->isOrientationNorth()) {
            return Direction::west();
        }

        if ($direction->isOrientationWest()) {
            return Direction::south();
        }

        if ($direction->isOrientationSouth()) {
            return Direction::east();
        }

        if ($direction->isOrientationEast()) {
            return Direction::north();
        }
    }
}
