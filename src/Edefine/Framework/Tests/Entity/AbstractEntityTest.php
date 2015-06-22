<?php

namespace Edefine\Framework\Tests\Entity;

use Edefine\Framework\Entity\AbstractEntity;

class AbstractEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMappedFieldsWithValues()
    {
        $entity = new FakeEntity();

        $entity->setId(123);
        $entity->setFoo('fooValue');
        $entity->setBar('barValue');

        $this->assertEquals([
            'id' => 123,
            'foo' => 'fooValue',
            'bar' => 'barValue'
        ], $entity->getMappedFieldsWithValues());
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

    public function setBar($bar)
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
}