<?php

namespace Rover\Domain\Task;

use Rover\Domain\Entity\Robot;

interface TaskInterface
{
    public function abbreviation(): string;

    public function execute(Robot $robot): void;
}
