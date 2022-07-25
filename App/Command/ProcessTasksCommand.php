<?php

namespace App\Command;

use Rover\Application\Service\ProcessTasksService;
use Rover\Domain\Collection\PositionCollection;
use Rover\Domain\ValueObject\Position;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

final class ProcessTasksCommand extends Command
{
    public function __construct(
        private ProcessTasksService $processTasksService
    ) {
        parent::__construct('robot:process:tasks');
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Processes the tasks and obtains the positions')
            ->addOption(
                'filePath',
                'fp',
                InputOption::VALUE_REQUIRED
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = $input->getOption('filePath');
        $symfonyStyle = new SymfonyStyle($input, $output);

        try {
            $positions = $this->processTasksService->process($filePath);
        } catch (Throwable $throwable) {
            $symfonyStyle->error($throwable->getTraceAsString());

            return self::FAILURE;
        }

        $this->printPositions($positions, $symfonyStyle);

        return self::SUCCESS;
    }

    private function printPositions(PositionCollection $positions, OutputInterface $output): void
    {
        /** @var Position $position */
        foreach ($positions as $position) {
            $output->writeln((string) $position);
        }
    }
}
