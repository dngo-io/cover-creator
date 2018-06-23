<?php
/**
 * Run "composer install" command line before you run this file
 */

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once 'config.php'; // Get sample config array

use DngoIO\CoverCreator\Generator;
$faker = Faker\Factory::create();
$rand  = (time() % count($config)) + 1;

try {
    $generator = new Generator();
    $generator->setConfig($config[$rand]['config']); //or new Generator($config)
    $generator->addLine($faker->sentence, $config[$rand]['text1']);
    $generator->addLine($faker->name, $config[$rand]['text2']);
    $generator->generate();
}catch (\Exception $e) {
    echo $e->getMessage();
}
