<?php

namespace Rover\Domain\Factory;

use Rover\Domain\Collection\TaskCollection;
use Rover\Domain\Registry\TaskRegistry;

class TaskCollectionFactory
{
    public function __construct(
        private TaskRegistry $registry
    ) {
    }

    public function createFromString(string $values): TaskCollection
    {
        $taskAbbreviations = str_split(trim($values));

        $tasks = [];
        foreach ($taskAbbreviations as $abbreviation) {
            $tasks[] = $this->registry->getByAbbreviation($abbreviation);
        }

        return new TaskCollection(...$tasks);
    }
}
