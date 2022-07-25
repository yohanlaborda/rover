<?php

namespace tests\App\Functional\Command;

use App\Command\ProcessTasksCommand;
use Rover\Application\Service\ProcessTasksService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

final class ProcessTasksCommandTest extends KernelTestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $application = new Application();
        $application->add(
            new ProcessTasksCommand(
                $container->get(ProcessTasksService::class)
            )
        );

        $this->commandTester = new CommandTester(
            $application->find('robot:process:tasks')
        );
    }

    public function testExecute()
    {
        $filePath = realpath(__DIR__ . '/../../resources/file.txt');
        $this->commandTester->execute(['--filePath' => $filePath]);

        $this->assertEquals(
            implode("\n", ['1 3 N','5 1 E']),
            trim($this->commandTester->getDisplay())
        );
    }
}
