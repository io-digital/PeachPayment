<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['bootstrap', 'storage', 'vendor', 'nova'])
    ->name('*.php')
    ->name('_ide_helper')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sortAlgorithm' => 'alpha'],
        'no_unused_imports' => true,
        'no_extra_consecutive_blank_lines' => true,
        'single_blank_line_before_namespace' => true,
        'trailing_comma_in_multiline_array' => true,
        'no_whitespace_in_blank_line' => true,
        'no_extra_consecutive_blank_lines' => true,
        'single_blank_line_before_namespace' => true,
        'trailing_comma_in_multiline_array' => true,
        'no_whitespace_in_blank_line' => true,
    ])
    ->setFinder($finder);
