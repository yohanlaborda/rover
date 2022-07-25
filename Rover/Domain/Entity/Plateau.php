<?php

namespace Rover\Domain\Entity;

use Rover\Domain\Collection\RobotCollection;
use Rover\Domain\ValueObject\Coordinate;
use Rover\Domain\ValueObject\Id;

class Plateau
{
    private RobotCollection $robots;

    public function __construct(
        private Id $id,
        private Coordinate $coordinate
    ) {
        $this->robots = new RobotCollection();
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function coordinate(): Coordinate
    {
        return $this->coordinate;
    }

    public function robots(): RobotCollection
    {
        return $this->robots;
    }

    public function setRobot(Robot $robot): void
    {
        $this->robots->append($robot);
    }

    public function getLastRobot(): ?Robot
    {
        if (0 === $this->robots->count()) {
            return null;
        }

        $robots = $this->robots->getArrayCopy();
        return array_pop($robots);
    }
}
