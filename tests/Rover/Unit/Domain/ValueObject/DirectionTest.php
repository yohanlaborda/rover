<?php

namespace tests\Rover\Unit\Domain\ValueObject;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Rover\Domain\ValueObject\Direction;

final class DirectionTest extends TestCase
{
    public function testFromStringThrowException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Orientations available are: N, W, E, S');

        Direction::fromString('Z');
    }

    public function testCreateFromOrientation(): void
    {
        self::assertSame('N', Direction::north()->orientation());
        self::assertSame('W', Direction::west()->orientation());
        self::assertSame('E', Direction::east()->orientation());
        self::assertSame('S', Direction::south()->orientation());
    }

    public function testIsOrientationNorth(): void
    {
        self::assertTrue(Direction::north()->isOrientationNorth());
        self::assertFalse(Direction::west()->isOrientationNorth());
    }

    public function testIsOrientationWest(): void
    {
        self::assertTrue(Direction::west()->isOrientationWest());
        self::assertFalse(Direction::south()->isOrientationWest());
    }

    public function testIsOrientationEast(): void
    {
        self::assertTrue(Direction::east()->isOrientationEast());
        self::assertFalse(Direction::west()->isOrientationEast());
    }

    public function testIsOrientationSouth(): void
    {
        self::assertTrue(Direction::south()->isOrientationSouth());
        self::assertFalse(Direction::north()->isOrientationSouth());
    }
}
