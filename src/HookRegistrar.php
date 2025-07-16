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

use VincentvdRee\WP_Hooked\Attributes\Action;
use VincentvdRee\WP_Hooked\Attributes\Filter;

class HookRegistrar
{
    public static function register(object $instance): void
    {
        $reflection = new \ReflectionClass($instance);

        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            foreach ($method->getAttributes() as $attribute) {
                $attr = $attribute->newInstance();

                if ($attr instanceof Action) {
                    add_action(
                        $attr->hook,
                        [$instance, $method->getName()],
                        $attr->priority,
                        $attr->accepted_args
                    );
                }

                if ($attr instanceof Filter) {
                    add_filter(
                        $attr->hook,
                        [$instance, $method->getName()],
                        $attr->priority,
                        $attr->accepted_args
                    );
                }
            }
        }
    }
}
