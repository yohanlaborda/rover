<?php

namespace Rover\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Stringable;

final class Id implements Stringable
{
    private function __construct(
        private UuidInterface $id
    ) {
    }

    public static function create(): self
    {
        return new self(
            Uuid::uuid4()
        );
    }

    public static function fromString(string $id): self
    {
        return new self(
            Uuid::fromString($id)
        );
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id->toString();
    }
}
