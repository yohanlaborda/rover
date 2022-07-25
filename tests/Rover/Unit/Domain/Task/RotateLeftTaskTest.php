<?php

namespace tests\Rover\Unit\Domain\Task;

use PHPUnit\Framework\TestCase;
use Rover\Domain\Entity\Robot;
use Rover\Domain\Task\RotateLeftTask;
use Rover\Domain\ValueObject\Direction;

final class RotateLeftTaskTest extends TestCase
{
    private RotateLeftTask $rotateLeftTask;

    protected function setUp(): void
    {
        $this->rotateLeftTask = new RotateLeftTask();
    }

    public function testAbbreviation(): void
    {
        self::assertSame('L', $this->rotateLeftTask->abbreviation());
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

        $this->rotateLeftTask->execute($robot);

        self::assertNotNull($directionSetUp);
        self::assertSame($expectedDirection, (string) $directionSetUp);
    }

    public function directionDataProvider(): array
    {
        return [
            'direction-north' => [
                Direction::north(),
                'W'
            ],
            'direction-west' => [
                Direction::west(),
                'S'
            ],
            'direction-east' => [
                Direction::east(),
                'N'
            ],
            'direction-south' => [
                Direction::south(),
                'E'
            ]
        ];
    }
}
