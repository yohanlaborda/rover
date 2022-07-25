<?php

namespace tests\Rover\Unit\Infrastructure\Storage;

use PHPUnit\Framework\TestCase;
use Rover\Infrastructure\Storage\FileStorage;
use RuntimeException;

final class FileStorageTest extends TestCase
{
    private FileStorage $fileStorage;

    protected function setUp(): void
    {
        $this->fileStorage = new FileStorage();
    }

    public function testReadFromPathThrowException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectErrorMessage('File "file.txt" does not exist');

        $this->fileStorage->readFromPath('file.txt');
    }

    public function testReadFromPath(): void
    {
        $file = tmpfile();
        $metaData = stream_get_meta_data($file);

        self::assertSame(
            [],
            $this->fileStorage->readFromPath($metaData['uri'])
        );
    }
}
