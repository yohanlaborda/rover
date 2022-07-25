<?php

namespace tests\Rover\Unit\Domain\Factory;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Rover\Domain\Factory\TaskCollectionFactory;
use Rover\Domain\Registry\TaskRegistry;
use Rover\Domain\Task\TaskInterface;

final class TaskCollectionFactoryTest extends TestCase
{
    private TaskRegistry|MockObject $taskRegistryMock;
    private TaskCollectionFactory $taskCollectionFactory;

    protected function setUp(): void
    {
        $this->taskRegistryMock = $this->createMock(TaskRegistry::class);
        $this->taskCollectionFactory = new TaskCollectionFactory($this->taskRegistryMock);
    }

    public function testCreateFromString(): void
    {
        $this->taskRegistryMock
            ->expects(self::exactly(4))
            ->method('getByAbbreviation')
            ->withConsecutive(
                ['L'], ['M'], ['R'], ['M']
            )
            ->willReturn(
                $this->createMock(TaskInterface::class)
            );

        self::assertCount(
            4,
            $this->taskCollectionFactory->createFromString('LMRM')
        );
    }
}
