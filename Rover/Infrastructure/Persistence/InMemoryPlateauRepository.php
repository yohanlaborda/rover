<?php

namespace Rover\Infrastructure\Persistence;

use Rover\Domain\Entity\Plateau;
use Rover\Domain\Repository\PlateauRepositoryInterface;

class InMemoryPlateauRepository implements PlateauRepositoryInterface
{
    /**
     * @var array<string, Plateau>
     */
    private array $plateaus = [];

    public function save(Plateau $plateau): void
    {
        $this->plateaus[(string) $plateau->id()] = $plateau;
    }
}
