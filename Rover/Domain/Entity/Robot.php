<?php

namespace Rover\Domain\Entity;

use Rover\Domain\ValueObject\Coordinate;
use Rover\Domain\ValueObject\Direction;
use Rover\Domain\ValueObject\Id;

class Robot
{
    public function __construct(
        private Id $id,
        private Plateau $plateau,
        private Coordinate $coordinate,
        private Direction $direction
    ) {
        $this->setPlateau($plateau);
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function plateau(): Plateau
    {
        return $this->plateau;
    }

    public function setPlateau(Plateau $plateau): void
    {
        $this->plateau = $plateau;
        $this->plateau->setRobot($this);
    }

    public function coordinate(): Coordinate
    {
        return $this->coordinate;
    }

    public function setCoordinate(Coordinate $coordinate): void
    {
        $this->coordinate = $coordinate;
    }

    public function direction(): Direction
    {
        return $this->direction;
    }

    public function setDirection(Direction $direction): void
    {
        $this->direction = $direction;
    }
}
