<?php

namespace tests\Rover\Unit\Domain\Collection;

use Rover\Domain\Collection\TaskCollection;
use Rover\Domain\Task\TaskInterface;

final class TaskCollectionTest extends AbstractCollectionTest
{
    protected function className(): string
    {
        return TaskCollection::class;
    }

    protected function object(): object
    {
        return $this->createMock(TaskInterface::class);
    }

    protected function objectClassName(): string
    {
        return TaskInterface::class;
    }
}
