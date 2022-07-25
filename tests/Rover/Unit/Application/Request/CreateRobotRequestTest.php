<?php

namespace tests\Rover\Unit\Application\Request;

use PHPUnit\Framework\TestCase;
use Rover\Application\Request\CreateRobotRequest;
use Rover\Domain\Entity\Plateau;

final class CreateRobotRequestTest extends TestCase
{
    /**
     * @dataProvider linesDataProvider
     */
    public function testFromLine(string $line, int $expectedX, int $expectedY, string $expectedOrientation): void
    {
        $request = CreateRobotRequest::fromLine(
            $line,
            $this->createMock(Plateau::class)
        );

        self::assertSame($expectedX, $request->x());
        self::assertSame($expectedY, $request->y());
        self::assertSame($expectedOrientation, $request->orientation());
    }

    public function linesDataProvider(): array
    {
        return [
            'west' => ['10 1 W', 10, 1, 'W'],
            'north' => ['5 7 N', 5, 7, 'N']
        ];
    }
}
