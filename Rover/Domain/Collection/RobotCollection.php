<?php

namespace Rover\Domain\Collection;

use Rover\Domain\Entity\Robot;

class RobotCollection extends AbstractCollection
{
    public function __construct(Robot ...$robots)
    {
        parent::__construct($robots);
    }

    protected function className(): string
    {
        return Robot::class;
    }

    protected function validate($value): bool
    {
        return $value instanceof Robot;
    }
}
