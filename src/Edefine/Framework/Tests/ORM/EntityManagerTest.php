<?php

namespace Edefine\Framework\Tests\ORM;

use Edefine\Framework\ORM\EntityManager;

class EntityManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testSaveSavesNewEntity()
    {
        $connectionMock = $this->getMockBuilder('Edefine\Framework\Database\Connection')
            ->disableOriginalConstructor()
            ->getMock();

        $connectionMock
            ->expects($this->once())
            ->method('exec')
            ->with('insert into foo (id, bar) values (NULL, "baz")');

        $connectionMock
            ->expects($this->once())
            ->method('lastInsertId')
            ->will($this->returnValue(123));

        $entityMock = $this->getMockBuilder('Edefine\Framework\Entity\AbstractEntity')
            ->disableOriginalConstructor()
            ->getMock();

        $entityMock
            ->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(null));

        $entityMock
            ->expects($this->any())
            ->method('getTableName')
            ->will($this->returnValue('foo'));

        $entityMock
            ->expects($this->any())
            ->method('getMappedFields')
            ->will($this->returnValue(['id', 'bar']));

        $entityMock
            ->expects($this->any())
            ->method('getMappedFieldsWithValues')
            ->will($this->returnValue(['id' => null, 'bar' => 'baz']));

        $entityMock
            ->expects($this->once())
            ->method('setId')
            ->with(123);

        $manager = new EntityManager($connectionMock);
        $manager->save($entityMock);
    }

    public function testSaveUpdatesEntity()
    {
        $connectionMock = $this->getMockBuilder('Edefine\Framework\Database\Connection')
            ->disableOriginalConstructor()
            ->getMock();

        $connectionMock
            ->expects($this->once())
            ->method('exec')
            ->with('update foo set id = "123", bar = "baz" where id = 123');

        $entityMock = $this->getMockBuilder('Edefine\Framework\Entity\AbstractEntity')
            ->disableOriginalConstructor()
            ->getMock();

        $entityMock
            ->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(123));

        $entityMock
            ->expects($this->any())
            ->method('getTableName')
            ->will($this->returnValue('foo'));

        $entityMock
            ->expects($this->any())
            ->method('getMappedFields')
            ->will($this->returnValue(['id', 'bar']));

        $entityMock
            ->expects($this->any())
            ->method('getMappedFieldsWithValues')
            ->will($this->returnValue(['id' => 123, 'bar' => 'baz']));

        $manager = new EntityManager($connectionMock);
        $manager->save($entityMock);
    }

    public function testRemove()
    {
        $connectionMock = $this->getMockBuilder('Edefine\Framework\Database\Connection')
            ->disableOriginalConstructor()
            ->getMock();

        $connectionMock
            ->expects($this->once())
            ->method('exec')
            ->with('delete from foo where id = 123');

        $entityMock = $this->getMockBuilder('Edefine\Framework\Entity\AbstractEntity')
            ->disableOriginalConstructor()
            ->getMock();

        $entityMock
            ->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(123));

        $entityMock
            ->expects($this->any())
            ->method('getTableName')
            ->will($this->returnValue('foo'));

        $manager = new EntityManager($connectionMock);
        $manager->remove($entityMock);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Entity was not persisted yet
     */
    public function testRemoveThrowsExceptionWhenEntityWasNotPersisted()
    {
        $connectionMock = $this->getMockBuilder('Edefine\Framework\Database\Connection')
            ->disableOriginalConstructor()
            ->getMock();

        $entityMock = $this->getMockBuilder('Edefine\Framework\Entity\AbstractEntity')
            ->disableOriginalConstructor()
            ->getMock();

        $entityMock
            ->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(null));

        $manager = new EntityManager($connectionMock);
        $manager->remove($entityMock);
    }
}
