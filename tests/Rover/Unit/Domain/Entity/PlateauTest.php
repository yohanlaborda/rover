<?php

namespace tests\Rover\Unit\Domain\Entity;

use PHPUnit\Framework\TestCase;
use Rover\Domain\Entity\Plateau;
use Rover\Domain\Entity\Robot;
use Rover\Domain\ValueObject\Coordinate;
use Rover\Domain\ValueObject\Id;

final class PlateauTest extends TestCase
{
    private Plateau $plateau;

    protected function setUp(): void
    {
        $this->plateau = new Plateau(
            Id::create(),
            Coordinate::fromString('5', '10')
        );
    }

    public function testGetLastRobot(): void
    {
        self::assertNull($this->plateau->getLastRobot());

        $firstRobot = $this->createMock(Robot::class);
        $secondRobot = $this->createMock(Robot::class);

        $this->plateau->setRobot($firstRobot);
        $this->plateau->setRobot($secondRobot);

        self::assertSame($secondRobot, $this->plateau->getLastRobot());
    }
}
