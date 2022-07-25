<?php

namespace Rover\Domain\Task;

use Rover\Domain\Entity\Robot;
use Rover\Domain\ValueObject\Direction;

abstract class AbstractRotateTask implements TaskInterface
{
    public function execute(Robot $robot): void
    {
        $robot->setDirection(
            $this->rotate($robot->direction())
        );
    }

    abstract protected function rotate(Direction $direction): Direction;
}
