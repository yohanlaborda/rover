<?php

namespace tests\Rover\Unit\Domain\Factory;

use PHPUnit\Framework\TestCase;
use Rover\Domain\Factory\PlateauFactory;

final class PlateauFactoryTest extends TestCase
{
    private PlateauFactory $plateauFactory;

    protected function setUp(): void
    {
        $this->plateauFactory = new PlateauFactory();
    }

    public function testCreate(): void
    {
        $plateau = $this->plateauFactory->create('10', '11');

        self::assertSame('10 11', (string) $plateau->coordinate());
    }
}
