<?php

namespace Edefine\Framework\Tests\Database;

use Edefine\Framework\Database\ValueConverter;
use Edefine\Framework\Entity\AbstractEntity;

class ValueConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testConvertToDatabase()
    {
        $this->assertEquals('""', ValueConverter::convertToDatabase(''));
        $this->assertEquals('"test"', ValueConverter::convertToDatabase('test'));

        $this->assertEquals('"2015-01-02 03:04:05"', ValueConverter::convertToDatabase(new \DateTime('2015-01-02 03:04:05')));

        $this->assertEquals('NULL', ValueConverter::convertToDatabase(null));
    }

    public function testConvertToEntity()
    {
        $entity = new FakeEntity();

        $this->assertEquals('test', ValueConverter::convertToEntity($entity, 'baz', 'test'));

        $this->assertEquals(new \DateTime('2015-01-02 03:04:05'), ValueConverter::convertToEntity($entity, 'bar', '2015-01-02 03:04:05'));
    }
}

class FakeEntity extends AbstractEntity
{
    private $foo;
    private $bar;

    public function getFoo()
    {
        return $this->foo;
    }

    public function setFoo($foo)
    {
        $this->foo = $foo;

        return $this;
    }

    public function getBar()
    {
        return $this->bar;
    }

    public function setBar(\DateTime $bar)
    {
        $this->bar = $bar;

        return $this;
    }

    public function getTableName()
    {
        return 'fake_entity';
    }

    public function getMappedFields()
    {
        return ['id', 'foo', 'bar'];
    }

    public function getDateTimeFields()
    {
        return ['bar'];
    }
}