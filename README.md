# WP-Hooked

WP-Hooked is a modern PHP package for registering WordPress actions and filters using PHP 8 attributes. It provides a clean and object-oriented approach to managing hooks in your WordPress projects.

## Features
- Register WordPress actions and filters using PHP attributes
- Supports priorities and accepted arguments
- Clean, maintainable, and testable code structure
- Composer compatible

## Requirements
- PHP 8.0 or higher
- WordPress 5.8 or higher

## Installation
You can install WP-Hooked via Composer. Run the following command in your WordPress project directory:

```bash
composer require vincentvdree/wp-hooked
```

## Usage
To use WP-Hooked, you need to create a class and define your hooks using attributes. Here's a simple example:

```php src/MyHooks.php
namespace MyNamespace;

use VincentvdRee\WP_Hooked\Attributes\Action;
use VincentvdRee\WP_Hooked\Attributes\Filter;

class MyHooks
{
    #[Action('init')]
    public function onInit() {
        // Your code here
    }

    #[Filter('the_content', priority: 20, accepted_args: 2)]
    public function filterContent($content, $postId) {
        // Your code here
        return $content;
    }
}
```

```php functions.php
use VincentvdRee\WP_Hooked\HookRegistrar;

$hooked = new Hooked(namespace: 'MyNamespace');
$hooked->init();
```

