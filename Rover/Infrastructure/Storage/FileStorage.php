<?php

namespace Rover\Infrastructure\Storage;

use Rover\Domain\Storage\StorageInterface;
use RuntimeException;

class FileStorage implements StorageInterface
{
    public function readFromPath(string $path): array
    {
        $fileContent = file_exists($path) ? file($path) : false;
        if (false === $fileContent) {
            throw new RuntimeException(
                sprintf('File "%s" does not exist', $path)
            );
        }

        return $fileContent;
    }
}
