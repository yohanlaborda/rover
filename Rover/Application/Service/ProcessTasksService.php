<?php

namespace Rover\Application\Service;

use Rover\Application\Request\CreateRobotRequest;
use Rover\Domain\Collection\PositionCollection;
use Rover\Domain\Entity\Plateau;
use Rover\Domain\Entity\Robot;
use Rover\Domain\Factory\TaskCollectionFactory;
use Rover\Domain\Service\ExecuteTaskCollectionService;
use Rover\Domain\Storage\StorageInterface;
use Rover\Domain\ValueObject\Position;

class ProcessTasksService
{
    private Plateau $plateau;

    /** @var Position[] */
    private array $positions = [];
    private bool $firstTime = true;

    public function __construct(
        private StorageInterface $storage,
        private CreatePlateauService $createPlateauService,
        private CreateRobotService $createRobotService,
        private TaskCollectionFactory $taskCollectionFactory,
        private ExecuteTaskCollectionService $executeTaskCollectionService
    ) {
    }

    public function process(string $path): PositionCollection
    {
        $fileContent = $this->storage->readFromPath($path);
        $firstLine = array_shift($fileContent);
        $plateau = $this->createPlateauService->createFromLine($firstLine);

        foreach ($fileContent as $line) {
            $this->processLine($line, $plateau);
        }

        return new PositionCollection(...$this->positions);
    }

    private function processLine(string $line, Plateau $plateau): void
    {
        if ($this->firstTime) {
            $this->createRobotFromLine($line, $plateau);
            $this->firstTime = false;
            return;
        }

        $this->positions[] = $this->executeTaskCollectionService->execute(
            $plateau->getLastRobot(),
            $this->taskCollectionFactory->createFromString($line)
        );
        $this->firstTime = true;
    }

    private function createRobotFromLine(string $line, Plateau $plateau): Robot
    {
        return $this->createRobotService->create(
            CreateRobotRequest::fromLine($line, $plateau)
        );
    }
}
