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

namespace VincentvdRee\WP_Hooked\Attributes;

#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Filter
{
    public function __construct(
        public string $hook,
        public int $priority = 10,
        public int $accepted_args = 1,
    ) {}
}
