<?php

namespace Rover\Domain\Exception;

use DomainException;
use Throwable;

final class TaskException extends DomainException
{
    private function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct(
            $message,
            $previous ? $previous->getCode() : 0,
            $previous
        );
    }

    public static function abbreviationNotExist(string $abbreviation): self
    {
        return new self(
            sprintf('Task with abbreviation %s does not exist', $abbreviation)
        );
    }
}
