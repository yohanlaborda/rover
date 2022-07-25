<?php

namespace tests\Rover\Unit\Domain\Task;

use PHPUnit\Framework\TestCase;
use Rover\Domain\Entity\Robot;
use Rover\Domain\Task\MoveTask;
use Rover\Domain\ValueObject\Coordinate;
use Rover\Domain\ValueObject\Direction;

final class MoveTaskTest extends TestCase
{
    private MoveTask $moveTask;

    protected function setUp(): void
    {
        $this->moveTask = new MoveTask();
    }

    public function testAbbreviation(): void
    {
        self::assertSame('M', $this->moveTask->abbreviation());
    }

    /**
     * @dataProvider coordinateDataProvider
     */
    public function testExecute(Direction $direction, Coordinate $coordinate, string $expectedCoordinate): void
    {
        $robot = $this->createMock(Robot::class);
        $robot->method('direction')->willReturn($direction);
        $robot->method('coordinate')->willReturn($coordinate);

        $coordinateSetUp = null;

        $robot
            ->expects(self::once())
            ->method('setCoordinate')
            ->willReturnCallback(
                static function (Coordinate $coordinate) use (&$coordinateSetUp) {
                    $coordinateSetUp = $coordinate;
                }
            );

        $this->moveTask->execute($robot);

        self::assertNotNull($coordinateSetUp);
        self::assertSame($expectedCoordinate, (string) $coordinateSetUp);
    }

    public function coordinateDataProvider(): array
    {
        return [
            'direction-north' => [
                Direction::north(),
                Coordinate::fromString('10', '10'),
                '10 11'
            ],
            'direction-west' => [
                Direction::west(),
                Coordinate::fromString('10', '10'),
                '9 10'
            ],
            'direction-east' => [
                Direction::east(),
                Coordinate::fromString('10', '10'),
                '11 10'
            ],
            'direction-south' => [
                Direction::south(),
                Coordinate::fromString('10', '10'),
                '10 9'
            ]
        ];
    }
}
