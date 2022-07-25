<?php

namespace Rover\Domain\ValueObject;

use Stringable;

final class Coordinate implements Stringable
{
    private function __construct(
        private int $x,
        private int $y
    ) {
    }

    public static function fromString(string $x, string $y): self
    {
        return new self(
            (int) $x,
            (int) $y
        );
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function addOneToX(): self
    {
        return new self($this->x + 1, $this->y);
    }

    public function addOneToY(): self
    {
        return new self($this->x, $this->y + 1);
    }

    public function subtractOneToX(): self
    {
        return new self($this->x - 1, $this->y);
    }

    public function subtractOneToY(): self
    {
        return new self($this->x, $this->y - 1);
    }

    public function __toString(): string
    {
        return sprintf(
            '%d %d',
            $this->x,
            $this->y
        );
    }
}
