<?php

namespace tests\Rover\Unit\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use Rover\Domain\ValueObject\Coordinate;

final class CoordinateTest extends TestCase
{
    public function testFromString(): void
    {
        $coordinate = Coordinate::fromString('1', '-1');

        self::assertSame(1, $coordinate->x());
        self::assertSame(-1, $coordinate->y());
    }

    public function testAddOneToX(): void
    {
        $coordinate = Coordinate::fromString('1', '1');

        self::assertSame(2, $coordinate->addOneToX()->x());
    }

    public function testAddOneToY(): void
    {
        $coordinate = Coordinate::fromString('1', '10');

        self::assertSame(11, $coordinate->addOneToY()->y());
    }

    public function testSubtractOneToX(): void
    {
        $coordinate = Coordinate::fromString('1', '10');

        self::assertSame(0, $coordinate->subtractOneToX()->x());
    }

    public function testSubtractOneToY(): void
    {
        $coordinate = Coordinate::fromString('1', '10');

        self::assertSame(9, $coordinate->subtractOneToY()->y());
    }
}
