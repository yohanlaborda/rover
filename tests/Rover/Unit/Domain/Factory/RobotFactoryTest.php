<?php

namespace tests\Rover\Unit\Domain\Factory;

use PHPUnit\Framework\TestCase;
use Rover\Domain\Entity\Plateau;
use Rover\Domain\Factory\RobotFactory;

final class RobotFactoryTest extends TestCase
{
    private RobotFactory $robotFactory;

    protected function setUp(): void
    {
        $this->robotFactory = new RobotFactory();
    }

    public function testCreate(): void
    {
        $robot = $this->robotFactory->create(
            $this->createMock(Plateau::class),
            10,
            15,
            'N'
        );

        self::assertSame('10 15', (string) $robot->coordinate());
        self::assertSame('N', (string) $robot->direction());
    }
}
