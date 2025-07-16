<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

return (new Config())
    ->setParallelConfig(ParallelConfigFactory::detect()) // @TODO 4.0 no need to call this manually
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP82Migration' => true,
        '@PHP82Migration:risky' => true,
        '@PHPUnit100Migration:risky' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        'general_phpdoc_annotation_remove' => ['annotations' => ['expectedDeprecation']], // one should use PHPUnit built-in method instead
        'header_comment' => ['header' => <<<'EOF'
            This file is part of WP-Hooked.

            (c) Vincent van der Ree <vincentvanderree@proton.me>

            This source file is subject to the MIT license that is bundled
            with this source code in the file LICENSE.
            EOF],
        'modernize_strpos' => true, // needs PHP 8+ or polyfill
        'native_constant_invocation' => ['strict' => false], // strict:false to not remove `\` on low-end PHP versions for not-yet-known consts
        'no_useless_concat_operator' => false, // TODO switch back on when the `src/Console/Application.php` no longer needs the concat
        'phpdoc_order' => [
            'order' => [
                'type',
                'template',
                'template-covariant',
                'template-extends',
                'extends',
                'implements',
                'property',
                'method',
                'param',
                'return',
                'var',
                'assert',
                'assert-if-false',
                'assert-if-true',
                'throws',
                'author',
                'see',
            ],
        ],
    ])
    ->setFinder(
        (new Finder())
            ->ignoreDotFiles(false)
            ->ignoreVCSIgnored(true)
            ->in([
                __DIR__ . '/src',
            ])
    );
