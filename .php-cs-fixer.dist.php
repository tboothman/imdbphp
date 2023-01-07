<?php

$config = new PhpCsFixer\Config();

return $config
    ->setRules(array(
        '@PER' => true,
    ))
    ->setFinder(PhpCsFixer\Finder::create()
        ->exclude(array(
            'demo',
        ))
        ->in(__DIR__)
    );
