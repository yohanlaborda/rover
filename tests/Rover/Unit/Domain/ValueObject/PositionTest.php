<?php

namespace tests\Rover\Unit\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use Rover\Domain\Entity\Robot;
use Rover\Domain\Factory\RobotFactory;
use Rover\Domain\ValueObject\Coordinate;
use Rover\Domain\ValueObject\Direction;
use Rover\Domain\ValueObject\Position;

final class PositionTest extends TestCase
{
    public function testFrom(): void
    {
        $position = Position::from(
            Coordinate::fromString('1', '10'),
            Direction::north()
        );

        self::assertSame('1 10 N', (string) $position);
    }

    public function testFromRobot(): void
    {
        $robot = $this->createMock(Robot::class);
        $robot->method('coordinate')->willReturn(Coordinate::fromString('2', '5'));
        $robot->method('direction')->willReturn(Direction::east());

        $position = Position::fromRobot($robot);

        self::assertSame('2 5', (string) $position->coordinate());
        self::assertSame('E', (string) $position->direction());
        self::assertSame('2 5 E', (string) $position);
    }
}
