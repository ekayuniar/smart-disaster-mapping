<?php

declare(strict_types=1);

namespace App\Bnpb\Phpml\Dataset\Demo;

use App\Bnpb\Phpml\Dataset\CsvDataset;

/**
 * Classes: 3
 * Samples per class: 50
 * Samples total: 150
 * Features per sample: 4.
 */
class IrisDataset extends CsvDataset
{
    public function __construct()
    {
        $filepath = __DIR__.'/../../../data/iris.csv';
        parent::__construct($filepath, 4, true);
    }
}
