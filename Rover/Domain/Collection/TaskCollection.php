<?php

namespace Rover\Domain\Collection;

use Rover\Domain\Task\TaskInterface;

class TaskCollection extends AbstractCollection
{
    public function __construct(TaskInterface ...$commands)
    {
        parent::__construct($commands);
    }

    protected function className(): string
    {
        return TaskInterface::class;
    }

    protected function validate($value): bool
    {
        return $value instanceof TaskInterface;
    }
}
