<?php

namespace tests\Rover\Unit\Domain\Collection;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Rover\Domain\Collection\AbstractCollection;
use stdClass;

abstract class AbstractCollectionTest extends TestCase
{
    protected function getCollection(): AbstractCollection
    {
        $className = $this->className();

        return new $className();
    }

    abstract protected function className(): string;

    abstract protected function object(): object;

    abstract protected function objectClassName(): string;

    public function testAppendThrowException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage(sprintf(
            'Object must be an instance of %s',
            $this->objectClassName()
        ));

        $this->getCollection()->append(new stdClass());
    }

    public function testAppend(): void
    {
        $collection = $this->getCollection();
        $collection->append($this->object());

        self::assertCount(1, $collection);
    }

    public function testOffsetSetThrowException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage(sprintf(
            'Object must be an instance of %s',
            $this->objectClassName()
        ));

        $this->getCollection()->offsetSet('1', new stdClass());
    }

    public function testOffsetSet(): void
    {
        $object = $this->object();
        $collection = $this->getCollection();
        $collection->offsetSet('1', $object);

        self::assertSame($object, $collection->offsetGet('1'));
    }
}
