<?php

namespace tests\Rover\Integration\Application\Service;

use Rover\Application\Service\ProcessTasksService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class ProcessTasksServiceTest extends KernelTestCase
{
    private ProcessTasksService $processTasksService;

    protected function setUp(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $this->processTasksService = $container->get(ProcessTasksService::class);
    }

    public function testProcess(): void
    {
        $filePath = realpath(__DIR__ . '/../../../resources/file.txt');
        $positions = $this->processTasksService->process($filePath);

        self::assertCount(2, $positions);
        self::assertSame('1 3 N', (string) $positions[0]);
        self::assertSame('5 1 E', (string) $positions[1]);
    }
}
