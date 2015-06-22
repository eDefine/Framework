<?php

namespace Weight;

use Entity\Weight;

class Calculator
{
    /** @var Weight[] */
    private $weights;

    public function __construct(array $weights)
    {
        $this->weights = $weights;
    }

    /**
     * @return int|null
     */
    public function getDayDifference()
    {
        $firstWeight = $this->getFirstWeight();
        $lastWeight = $this->getLastWeight();

        if (!$firstWeight || !$lastWeight) {
            return null;
        }

        $difference = $firstWeight->getDate()->diff($lastWeight->getDate());

        return $difference->format('%a');
    }

    /**
     * @return int|null
     */
    public function getWeightDifference()
    {
        $firstWeight = $this->getFirstWeight();
        $lastWeight = $this->getLastWeight();

        if (!$firstWeight || !$lastWeight) {
            return null;
        }

        return $firstWeight->getValue() - $lastWeight->getValue();
    }

    /**
     * @param int $perDays
     * @return float|null
     */
    public function getRatio($perDays = 1)
    {
        $dayDifference = $this->getDayDifference();
        $weightDifference = $this->getWeightDifference();

        if (!$dayDifference || !$weightDifference) {
            return null;
        }

        return $perDays * $weightDifference / $dayDifference;
    }

    /**
     * @return Weight|null
     */
    private function getFirstWeight()
    {
        $firstWeight = null;
        foreach ($this->weights as $weight) {
            if (!$firstWeight || ($weight->getDate() < $firstWeight->getDate())) {
                $firstWeight = $weight;
            }
        }

        return $firstWeight;
    }

    /**
     * @return Weight|null
     */
    private function getLastWeight()
    {
        $lastWeight = null;
        foreach ($this->weights as $weight) {
            if (!$lastWeight || ($weight->getDate() > $lastWeight->getDate())) {
                $lastWeight = $weight;
            }
        }

        return $lastWeight;
    }
}