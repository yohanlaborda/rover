<?php

namespace tests\Rover\Unit\Domain\Collection;

use Rover\Domain\Collection\RobotCollection;
use Rover\Domain\Entity\Robot;

final class RobotCollectionTest extends AbstractCollectionTest
{
    protected function className(): string
    {
        return RobotCollection::class;
    }

    protected function object(): object
    {
        return $this->createMock(Robot::class);
    }

    protected function objectClassName(): string
    {
        return Robot::class;
    }
}
