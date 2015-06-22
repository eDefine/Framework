<?php

namespace Console;

use Edefine\Framework\Console\AbstractJob;
use Edefine\Framework\Console\Input\InputInterface;
use Edefine\Framework\Console\Output\ChainOutput;
use Edefine\Framework\Console\Output\LogOutput;
use Edefine\Framework\Console\Output\OutputInterface;
use Edefine\Framework\Log\Writer;

class WeightConsolidation extends AbstractJob
{
    public function getName()
    {
        return 'weight:consolidation';
    }

    public function getInfo()
    {
        return 'Runs weight consolidation';
    }

    public function run(InputInterface $input, OutputInterface $output)
    {
        $chainOutput = $this->buildChainOutput($output);

        $consolidation = $this->getContainer()->get('weightConsolidation');

        $consolidation->run($chainOutput);
    }

    private function buildChainOutput(OutputInterface $output)
    {
        $writer = new Writer(sprintf('%s/log/weight_consolidation.log', APP_DIR));
        $logOutput = new LogOutput($writer);

        $chainOutput = new ChainOutput();
        $chainOutput->addOutput($output);
        $chainOutput->addOutput($logOutput);

        return $chainOutput;
    }
}