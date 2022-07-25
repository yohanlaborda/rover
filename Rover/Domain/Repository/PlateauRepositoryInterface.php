<?php

namespace Rover\Domain\Repository;

use Rover\Domain\Entity\Plateau;

interface PlateauRepositoryInterface
{
    public function save(Plateau $plateau): void;
}
