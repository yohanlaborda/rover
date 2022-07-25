<?php

namespace Rover\Domain\ValueObject;

use InvalidArgumentException;
use Stringable;

final class Direction implements Stringable
{
    private const NORTH = 'N';
    private const WEST = 'W';
    private const EAST = 'E';
    private const SOUTH = 'S';

    private const LIST_ORIENTATIONS = [
        self::NORTH,
        self::WEST,
        self::EAST,
        self::SOUTH
    ];

    private function __construct(
        private string $orientation
    ) {
        $this->validate();
    }

    public static function fromString(string $orientation): self
    {
        return new self($orientation);
    }

    public static function north(): self
    {
        return self::fromString(self::NORTH);
    }

    public static function west(): self
    {
        return self::fromString(self::WEST);
    }

    public static function east(): self
    {
        return self::fromString(self::EAST);
    }

    public static function south(): self
    {
        return self::fromString(self::SOUTH);
    }

    private function validate(): void
    {
        if (false === in_array($this->orientation, self::LIST_ORIENTATIONS)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Orientations available are: %s',
                    implode(', ', self::LIST_ORIENTATIONS)
                )
            );
        }
    }

    public function orientation(): string
    {
        return $this->orientation;
    }

    public function isOrientationNorth(): bool
    {
        return self::NORTH === $this->orientation;
    }

    public function isOrientationWest(): bool
    {
        return self::WEST === $this->orientation;
    }

    public function isOrientationEast(): bool
    {
        return self::EAST === $this->orientation;
    }

    public function isOrientationSouth(): bool
    {
        return self::SOUTH === $this->orientation;
    }

    public function __toString(): string
    {
        return $this->orientation;
    }
}
