<?php

namespace Rover\Domain\Repository;

use Rover\Domain\Entity\Robot;

interface RobotRepositoryInterface
{
    public function save(Robot $robot): void;
}
