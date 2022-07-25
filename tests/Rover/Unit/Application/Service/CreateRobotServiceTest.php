<?php

namespace tests\Rover\Unit\Application\Service;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Rover\Application\Request\CreateRobotRequest;
use Rover\Application\Service\CreateRobotService;
use Rover\Domain\Entity\Plateau;
use Rover\Domain\Entity\Robot;
use Rover\Domain\Factory\RobotFactory;
use Rover\Domain\Repository\RobotRepositoryInterface;

final class CreateRobotServiceTest extends TestCase
{
    private MockObject|RobotFactory $robotFactoryMock;
    private MockObject|RobotRepositoryInterface $robotRepositoryMock;
    private CreateRobotService $createRobotService;

    protected function setUp(): void
    {
        $this->robotFactoryMock = $this->createMock(RobotFactory::class);
        $this->robotRepositoryMock = $this->createMock(RobotRepositoryInterface::class);

        $this->createRobotService = new CreateRobotService(
            $this->robotFactoryMock,
            $this->robotRepositoryMock
        );
    }

    public function test(): void
    {
        $plateau = $this->createMock(Plateau::class);

        $createRobotRequestMock = $this->createMock(CreateRobotRequest::class);
        $createRobotRequestMock->method('plateau')->willReturn($plateau);
        $createRobotRequestMock->method('x')->willReturn(10);
        $createRobotRequestMock->method('y')->willReturn(11);
        $createRobotRequestMock->method('orientation')->willReturn('N');

        $robotMock = $this->createMock(Robot::class);

        $this->robotFactoryMock
            ->expects(self::once())
            ->method('create')
            ->with($plateau, 10, 11, 'N')
            ->willReturn($robotMock);

        $this->robotRepositoryMock
            ->expects(self::once())
            ->method('save')
            ->with($robotMock);

        self::assertSame(
            $robotMock,
            $this->createRobotService->create($createRobotRequestMock)
        );
    }
}
