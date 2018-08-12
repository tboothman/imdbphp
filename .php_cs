<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
    ->exclude(['cache', 'conf', 'doc', 'vendor'])
    ->files()
    ->name('*.php')
;

return PhpCsFixer\Config::create()
    ->setUsingCache(true)
    ->setRiskyAllowed(true)
    ->setFinder($finder)
    ->setRules([
        '@PSR2'             => true,
        'psr4'              => true,
        'no_unused_imports' => true,
        'array_syntax'      => ['syntax' => 'short'],
    ])
;
