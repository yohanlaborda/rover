<?php

namespace Rover\Application\Service;

use Rover\Domain\Entity\Plateau;
use Rover\Domain\Factory\PlateauFactory;
use Rover\Domain\Repository\PlateauRepositoryInterface;

class CreatePlateauService
{
    private const SPLIT_REGULAR_EXPRESSION = '/\s/';

    public function __construct(
        private PlateauFactory $factory,
        private PlateauRepositoryInterface $repository
    ) {
    }

    public function createFromLine(string $line): Plateau
    {
        [$x, $y] = preg_split(self::SPLIT_REGULAR_EXPRESSION, $line);

        $plateau = $this->factory->create((int) $x, (int) $y);
        $this->repository->save($plateau);

        return $plateau;
    }
}
