<?php

namespace Edefine\Framework\Console;

use Edefine\Framework\Console\Input\InputInterface;
use Edefine\Framework\Console\Output\OutputInterface;
use Edefine\Framework\Fixture\AbstractFixture;
use Edefine\Framework\Fixture\FixtureIterator;

/**
 * Class FixturesLoad
 * @package Edefine\Framework\Console
 */
class FixturesLoad implements JobInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'fixtures:load';
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return 'Loads data fixtures';
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function run(InputInterface $input, OutputInterface $output)
    {
        $fixtureIterator = new FixtureIterator(APP_DIR . '/src/Fixture');
        foreach ($fixtureIterator as $fixture) {
            $fixtures[] = $fixture;
        }

        usort($fixtures, function(AbstractFixture $a, AbstractFixture $b){
            return ($a->getOrder() > $b->getOrder()) ? 1 : -1;
        });

        foreach ($fixtures as $fixture) {
            $output->writeln(sprintf("%d: Loading fixture %s", $fixture->getOrder(), get_class($fixture)));

            $fixture->load($output);
        }
    }
}