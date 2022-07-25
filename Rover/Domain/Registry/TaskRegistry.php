<?php

namespace Rover\Domain\Registry;

use Rover\Domain\Exception\TaskException;
use Rover\Domain\Task\TaskInterface;

class TaskRegistry
{
    /**
     * @var array<string, TaskInterface>
     */
    private array $tasks;

    public function __construct(iterable $tasks)
    {
        $this->addTasks($tasks);
    }

    public function getByAbbreviation(string $abbreviation): TaskInterface
    {
        $task = $this->tasks[$abbreviation] ?? null;
        if (null === $task) {
            throw TaskException::abbreviationNotExist($abbreviation);
        }

        return $task;
    }

    private function addTasks(iterable $tasks): void
    {
        /** @var TaskInterface $task */
        foreach ($tasks as $task) {
            $this->tasks[$task->abbreviation()] = $task;
        }
    }
}
