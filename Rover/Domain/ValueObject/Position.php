<?php

namespace Rover\Domain\ValueObject;

use Rover\Domain\Entity\Robot;
use Stringable;

final class Position implements Stringable
{
    private function __construct(
        private Coordinate $coordinate,
        private Direction $direction
    ) {
    }

    public static function fromRobot(Robot $robot): self
    {
        return self::from($robot->coordinate(), $robot->direction());
    }

    public static function from(Coordinate $coordinate, Direction $direction): self
    {
        return new self($coordinate, $direction);
    }

    public function direction(): Direction
    {
        return $this->direction;
    }

    public function coordinate(): Coordinate
    {
        return $this->coordinate;
    }

    public function __toString(): string
    {
        return sprintf(
            '%s %s',
            $this->coordinate,
            $this->direction
        );
    }
}
