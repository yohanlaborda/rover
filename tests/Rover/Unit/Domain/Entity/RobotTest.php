<?php

namespace tests\Rover\Unit\Domain\Entity;

use PHPUnit\Framework\TestCase;
use Rover\Domain\Entity\Plateau;
use Rover\Domain\Entity\Robot;
use Rover\Domain\ValueObject\Coordinate;
use Rover\Domain\ValueObject\Direction;
use Rover\Domain\ValueObject\Id;

final class RobotTest extends TestCase
{
    private Robot $robot;

    protected function setUp(): void
    {
        $this->robot = new Robot(
            Id::create(),
            $this->createMock(Plateau::class),
            Coordinate::fromString('5', '20'),
            Direction::south()
        );
    }

    public function testSetPlateau(): void
    {
        $plateau = $this->createMock(Plateau::class);
        $plateau
            ->expects(self::once())
            ->method('setRobot')
            ->with($this->robot);

        $this->robot->setPlateau($plateau);

        self::assertSame($plateau, $this->robot->plateau());
    }
}
