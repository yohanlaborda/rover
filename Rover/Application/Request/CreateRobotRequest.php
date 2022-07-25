<?php

namespace Rover\Application\Request;

use Rover\Domain\Entity\Plateau;

class CreateRobotRequest
{
    private function __construct(
        private Plateau $plateau,
        private int $x,
        private int $y,
        private string $orientation
    ) {
    }

    public static function fromLine(string $line, Plateau $plateau): self
    {
        $lineWithoutBlankSpace = trim($line);
        [$x, $y, $orientation] = preg_split('/\s/', $lineWithoutBlankSpace);

        return new self($plateau, (int) $x, (int) $y, $orientation);
    }

    public function plateau(): Plateau
    {
        return $this->plateau;
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function orientation(): string
    {
        return $this->orientation;
    }
}
