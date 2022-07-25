<?php

namespace Rover\Infrastructure\Persistence;

use Rover\Domain\Entity\Robot;
use Rover\Domain\Repository\RobotRepositoryInterface;

final class InMemoryRobotRepository implements RobotRepositoryInterface
{
    /**
     * @var array<string, Robot>
     */
    private array $robots = [];

    public function save(Robot $robot): void
    {
        $this->robots[(string) $robot->id()] = $robot;
    }
}
