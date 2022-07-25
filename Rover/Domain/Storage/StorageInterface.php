<?php

namespace Rover\Domain\Storage;

interface StorageInterface
{
    public function readFromPath(string $path): array;
}
