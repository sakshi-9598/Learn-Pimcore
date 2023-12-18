<?php

use Pimcore\Bundle\DataImporterBundle\PimcoreDataImporterBundle;
use Pimcore\Bundle\CustomReportsBundle\PimcoreCustomReportsBundle;


return [
    Pimcore\Bundle\SimpleBackendSearchBundle\PimcoreSimpleBackendSearchBundle::class => ['all' => true],
    Pimcore\Bundle\TinymceBundle\PimcoreTinymceBundle::class => ['all' => true],
    Pimcore\Bundle\DataHubBundle\PimcoreDataHubBundle::class => ['all' => true],
    PimcoreDataImporterBundle::class => ['all' => true],
    PimcoreCustomReportsBundle::class => ['all'=> true],
];
