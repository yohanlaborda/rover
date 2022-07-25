<?php

namespace tests\Rover\Unit\Domain\Registry;

use PHPUnit\Framework\TestCase;
use Rover\Domain\Exception\TaskException;
use Rover\Domain\Registry\TaskRegistry;
use Rover\Domain\Task\TaskInterface;

final class TaskRegistryTest extends TestCase
{
    public function testGetByAbbreviationThrowException(): void
    {
        $this->expectException(TaskException::class);
        $this->expectErrorMessage('Task with abbreviation A does not exist');

        $taskRegistry = new TaskRegistry([]);
        $taskRegistry->getByAbbreviation('A');
    }

    public function testGetByAbbreviation(): void
    {
        $firstTask = $this->createMock(TaskInterface::class);
        $firstTask->method('abbreviation')->willReturn('A');

        $secondTask = $this->createMock(TaskInterface::class);
        $secondTask->method('abbreviation')->willReturn('B');

        $taskRegistry = new TaskRegistry([$firstTask, $secondTask]);

        self::assertSame($firstTask, $taskRegistry->getByAbbreviation('A'));
        self::assertSame($secondTask, $taskRegistry->getByAbbreviation('B'));
    }
}
