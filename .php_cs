#!/usr/bin/env php
<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
;
return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setRiskyAllowed(false)
    ->setUsingCache(false)
//    ->setCacheFile(__DIR__.'/.php_cs.cache')
    ->setFinder($finder)
;
