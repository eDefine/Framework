<?php

namespace Weight;

use Edefine\Framework\Console\Output\OutputInterface;
use Edefine\Framework\ORM\EntityManager;
use Edefine\Framework\Utils\Stoper;
use Entity\Weight;
use Repository\WeightRepository;

class Consolidation
{
    private $manager;
    private $weightRepository;

    public function __construct(EntityManager $manager, WeightRepository $weightRepository)
    {
        $this->manager = $manager;
        $this->weightRepository = $weightRepository;
    }

    public function run(OutputInterface $output)
    {
        $output->writeln('Consolidation started');

        $stoper = new Stoper();
        $stoper->start();

        $monthsToConsolidate = $this->weightRepository->getMonthsToConsolidate();

        foreach ($monthsToConsolidate as $data) {
            $userId = $data['userId'];
            $year = $data['year'];
            $month = $data['month'];
            $number = $data['number'];

            if ($number > 1) {
                $this->consolidateMonth($userId, $year, $month, $output);
            } else {
                $output->writeln(sprintf('There is only 1 weight for userId %d, for year %d and month %d',
                    $userId,
                    $year,
                    $month
                ));
            }
        }

        $output->writeln(sprintf('Consolidation finished, execution time: %f seconds', $stoper->stop()));
    }

    private function consolidateMonth($userId, $year, $month, OutputInterface $output)
    {
        $startDate = new \DateTime(sprintf('%s-%s-01 00:00:00', $year, $month));
        $endDate = new \DateTime(sprintf('%s-%s-01 +1 month -1 second', $year, $month));

        $output->write(sprintf('Consolidating userId %s, year %s, month %s... ', $userId, $year, $month));
        $weights = $this->weightRepository->findAll([
            'userId' => $userId,
            sprintf('date >= "%s"', $startDate->format('Y-m-d H:i:s')),
            sprintf('date <= "%s"', $endDate->format('Y-m-d H:i:s'))
        ]);

        $count = 0;
        $sum = 0.0;
        $infos = [];

        foreach ($weights as $weight) {
            $count++;
            $sum += $weight->getValue();

            if ($weight->getInfo()) {
                $infos[] = $weight->getInfo();
            }

            $this->manager->remove($weight);
        }

        $average = number_format($sum / count($weights), 2);

        $weight = new Weight();
        $weight
            ->setUserId($userId)
            ->setDate(new \DateTime(sprintf('%s-%s-15', $year, $month)))
            ->setValue($average)
            ->setInfo(implode(PHP_EOL, $infos));

        $this->manager->save($weight);

        $output->writeln(sprintf('Done: Consolidated %d weights, with average of %.2f kg', $count, $average));
    }
}