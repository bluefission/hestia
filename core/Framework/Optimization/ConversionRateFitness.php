<?php
namespace BlueFission\Framework\Optimization;

use BlueFission\Bot\Genetic\FitnessFunction;

class ConversionRateFitness extends FitnessFunction {
    public function evaluate($individual): float {
        // Calculate the conversion rate for the given individual (configuration)
        // For example:
        $visitors = $individual->field('visitors') ?: 1;
        $conversions = $individual->field('conversions') ?: 0;
        $conversionRate = $conversions / $visitors;
        
        return $conversionRate;
    }
}