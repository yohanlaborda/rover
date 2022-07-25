<?php

namespace tests\Rover\Unit\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use Rover\Domain\ValueObject\Id;

final class IdTest extends TestCase
{
    public function testCreate(): void
    {
        $id = Id::create();

        self::assertSame(36, strlen((string) $id));
    }

    public function testFromString(): void
    {
        $id = Id::fromString('4dacb308-cd4b-4433-9147-abef0f03a571');

        self::assertSame(
            '4dacb308-cd4b-4433-9147-abef0f03a571',
            (string) $id->id()
        );
    }
}
