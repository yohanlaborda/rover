<?php

namespace Rover\Domain\Service;

use Rover\Domain\Collection\TaskCollection;
use Rover\Domain\Task\TaskInterface;
use Rover\Domain\Entity\Robot;
use Rover\Domain\ValueObject\Position;

class ExecuteTaskCollectionService
{
    public function execute(Robot $robot, TaskCollection $tasks): Position
    {
        /** @var TaskInterface $task */
        foreach ($tasks as $task) {
            $task->execute($robot);
        }

        return Position::fromRobot($robot);
    }
}
