<?php

namespace tests\Rover\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use Rover\Domain\Collection\TaskCollection;
use Rover\Domain\Entity\Robot;
use Rover\Domain\Service\ExecuteTaskCollectionService;
use Rover\Domain\Task\TaskInterface;
use Rover\Domain\ValueObject\Coordinate;
use Rover\Domain\ValueObject\Direction;

final class ExecuteTaskCollectionServiceTest extends TestCase
{
    private ExecuteTaskCollectionService $executeTaskCollectionService;

    protected function setUp(): void
    {
        $this->executeTaskCollectionService = new ExecuteTaskCollectionService();
    }

    public function testExecution(): void
    {
        $robot = $this->createMock(Robot::class);
        $robot->method('coordinate')->willReturn(Coordinate::fromString('10', '15'));
        $robot->method('direction')->willReturn(Direction::fromString('N'));

        $taskMock = $this->createMock(TaskInterface::class);
        $taskMock
            ->expects(self::once())
            ->method('execute')
            ->with($robot);

        $taskCollection = new TaskCollection($taskMock);

        $position = $this->executeTaskCollectionService->execute($robot, $taskCollection);

        self::assertSame('10 15 N', (string) $position);
    }
}
