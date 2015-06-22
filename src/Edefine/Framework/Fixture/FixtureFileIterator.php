<?php

namespace Edefine\Framework\Fixture;

/**
 * Class FixtureFileIterator
 * @package Edefine\Framework\Fixture
 */
class FixtureFileIterator extends \FilterIterator
{
    /**
     * @param $path
     */
    public function __construct($path)
    {
        $directoryIterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));

        parent::__construct($directoryIterator);
    }

    /**
     * @return bool
     */
    public function accept()
    {
        return preg_match('/.*Fixture.php/', $this->current()) == true;
    }
}