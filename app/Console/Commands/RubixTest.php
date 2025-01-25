<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Rubix\ML\Classifiers\KNearestNeighbors;
use Rubix\ML\Datasets\Labeled;

class RubixTest extends Command
{
    protected $signature = 'rubix:test';
    protected $description = 'Test Rubix ML installation';

    public function handle()
    {
        // Sample dataset
        $dataset = new Labeled([
            [1, 4, 7],
            [2, 5, 8],
            [3, 6, 9],
        ], ['cat', 'dog', 'cat']);

        // Model
        $estimator = new KNearestNeighbors(3);

        // Train
        $estimator->train($dataset);

        // Test
        $predictions = $estimator->predict(new \Rubix\ML\Datasets\Unlabeled([
            [2, 4, 6],
            [3, 3, 3],
        ]));

        $this->info('Predictions: ' . implode(', ', $predictions));

        return 0;
    }
}
