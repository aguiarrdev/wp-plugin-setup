<?php

declare(strict_types=1);

namespace WPlugin\WordPress\Services;

use WPlugin\WordPress\Domains\PostTypes\Example;

final class PostTypes implements InterfaceService
{
	public function initialize(): void
	{
        add_action('init', [$this, 'registerDomains'], 10);
    }

    public function registerDomains(): void
    {
        $postTypes = [
            Example::class
        ];

        foreach($postTypes as $postType) {
            if (class_exists($postType)) {
				$class = new $postType;
				$class->register();
			}
        }
    }
}