<?php

namespace tests\Rover\Unit\Application\Service;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Rover\Application\Service\CreatePlateauService;
use Rover\Domain\Entity\Plateau;
use Rover\Domain\Factory\PlateauFactory;
use Rover\Domain\Repository\PlateauRepositoryInterface;

final class CreatePlateauServiceTest extends TestCase
{
    private MockObject|PlateauFactory $plateauFactoryMock;
    private MockObject|PlateauRepositoryInterface $plateauRepositoryMock;
    private CreatePlateauService $createPlateauService;

    protected function setUp(): void
    {
        $this->plateauFactoryMock = $this->createMock(PlateauFactory::class);
        $this->plateauRepositoryMock = $this->createMock(PlateauRepositoryInterface::class);

        $this->createPlateauService = new CreatePlateauService(
            $this->plateauFactoryMock,
            $this->plateauRepositoryMock
        );
    }

    public function testCreateFromLine(): void
    {
        $plateauMock = $this->createMock(Plateau::class);

        $this->plateauFactoryMock
            ->expects(self::once())
            ->method('create')
            ->with(10, 15)
            ->willReturn($plateauMock);

        $this->plateauRepositoryMock
            ->expects(self::once())
            ->method('save')
            ->with($plateauMock);

        self::assertSame(
            $plateauMock,
            $this->createPlateauService->createFromLine('10 15')
        );
    }
}
