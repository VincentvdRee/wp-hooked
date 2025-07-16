<?php

declare(strict_types=1);

/*
 * This file is part of WP-Hooked.
 *
 * (c) Vincent van der Ree <vincentvanderree@proton.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace VincentvdRee\WP_Hooked;

class Hooked
{
    private string $themeDir;
    private string $themeSrc;
    private string $themeNamespace;

    public function __construct(string $dir = '', string $src = 'src', string $namespace = '')
    {
        $this->themeDir = $dir ?: get_template_directory();
        $this->themeSrc = $src;
        $this->themeNamespace = $namespace;
    }

    public function init(): void
    {
        $directory = "{$this->themeDir}/{$this->themeSrc}";
        if (!is_dir($directory)) {
            wp_die("The directory {$directory} does not exist. Please check your theme/plugin setup.");
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && 'php' === $file->getExtension()) {
                require_once $file->getPathname();
            }
        }

        $prefix = $this->themeNamespace ?: $this->themeSrc.'\\';

        foreach (get_declared_classes() as $class) {
            if (str_starts_with($class, $prefix)) {
                $reflection = new \ReflectionClass($class);
                if (!$reflection->isAbstract()) {
                    HookRegistrar::register($reflection->newInstance());
                }
            }
        }
    }
}
