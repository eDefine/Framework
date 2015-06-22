<?php

namespace Edefine\Framework\Fixture;

use Edefine\Framework\Dependency\Container;

/**
 * Class FixtureIterator
 * @package Edefine\Framework\Fixture
 */
class FixtureIterator implements \Iterator
{
    private $fileIterator;
    private $container;

    /**
     * @param $path
     * @param Container $container
     */
    public function __construct($path, Container $container)
    {
        $this->fileIterator = new FixtureFileIterator($path);
        $this->container = $container;
    }

    /**
     * @return mixed
     * @throws \RuntimeException
     */
    public function current()
    {
        $file = $this->fileIterator->current();

        $realPath = $file->getRealPath();

        $position = strpos($realPath, 'src/Fixture');

        if ($position === false) {
            throw new \RuntimeException(sprintf('Path %s is invalid', $realPath));
        }

        $classPath = substr($realPath, $position + strlen('src/Fixture/'));
        $classPath = str_replace('/', '\\', $classPath);

        $classPath = '\\Fixture\\' . preg_replace('/\.php$/', '', $classPath);

        return new $classPath($this->container);
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->fileIterator->key();
    }

    public function next()
    {
        $this->fileIterator->next();
    }

    public function rewind()
    {
        $this->fileIterator->rewind();
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->fileIterator->valid();
    }
}