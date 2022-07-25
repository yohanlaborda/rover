<?php

namespace tests\Rover\Unit\Domain\Task;

use PHPUnit\Framework\TestCase;
use Rover\Domain\Entity\Robot;
use Rover\Domain\Task\RotateRightTask;
use Rover\Domain\ValueObject\Direction;

final class RotateRightTaskTest extends TestCase
{
    private RotateRightTask $rotateRightTask;

    protected function setUp(): void
    {
        $this->rotateRightTask = new RotateRightTask();
    }

    public function testAbbreviation(): void
    {
        self::assertSame('R', $this->rotateRightTask->abbreviation());
    }

    /**
     * @dataProvider directionDataProvider
     */
    public function testExecute(Direction $direction, string $expectedDirection): void
    {
        $robot = $this->createMock(Robot::class);
        $robot->method('direction')->willReturn($direction);

        $directionSetUp = null;

        $robot
            ->expects(self::once())
            ->method('setDirection')
            ->willReturnCallback(
                static function (Direction $direction) use (&$directionSetUp) {
                    $directionSetUp = $direction;
                }
            );

        $this->rotateRightTask->execute($robot);

        self::assertNotNull($directionSetUp);
        self::assertSame($expectedDirection, (string) $directionSetUp);
    }

    public function directionDataProvider(): array
    {
        return [
            'direction-north' => [
                Direction::north(),
                'E'
            ],
            'direction-west' => [
                Direction::west(),
                'N'
            ],
            'direction-east' => [
                Direction::east(),
                'S'
            ],
            'direction-south' => [
                Direction::south(),
                'W'
            ]
        ];
    }
}
