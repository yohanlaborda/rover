<?php

namespace Rover\Application\Service;

use Rover\Application\Request\CreateRobotRequest;
use Rover\Domain\Entity\Robot;
use Rover\Domain\Factory\RobotFactory;
use Rover\Domain\Repository\RobotRepositoryInterface;

class CreateRobotService
{
    public function __construct(
        private RobotFactory $factory,
        private RobotRepositoryInterface $repository
    ) {
    }

    public function create(CreateRobotRequest $request): Robot
    {
        $robot = $this->createFromRequest($request);
        $this->repository->save($robot);

        return $robot;
    }

    private function createFromRequest(CreateRobotRequest $request): Robot
    {
        return $this->factory->create(
            $request->plateau(),
            $request->x(),
            $request->y(),
            $request->orientation()
        );
    }
}
