<?php
$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->exclude('view')
    ->exclude('config')
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/spec');

$config = Symfony\CS\Config\Config::create();
$config->fixers(Symfony\CS\FixerInterface::PSR2_LEVEL);
$config->finder($finder);
return $config;
