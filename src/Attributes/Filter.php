<?php

declare(strict_types=1);

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
