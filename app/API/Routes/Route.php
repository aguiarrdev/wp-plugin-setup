<?php

namespace WPlugin\API\Routes;

abstract class Route
{
	private string $namespace;

	protected function registerRoute(string $route, $callback, array $methods = ['GET']): void
	{
		register_rest_route($this->namespace, $route, [
			'methods'  => $methods,
			'callback' => $callback,
		    'permission_callback' => '__return_true',
		] );
	}
	protected function sendJsonResponse(string $message = '', bool $success = true, int $code = 200, array $data = [])
	{
		$args = [
			"message" => $message,
			"success" => $success,
			"data"    => $data,
		];

		foreach ($args as $key => $item) {
			if (empty($item)) {
				unset($args[$key]);
			}
		}

		if (!empty($data)) {
			$args['data'] = $data;
		}

		return wp_send_json($args, $code);
	}

	protected function getNamespace(): string
	{
		return $this->namespace;
	}

	protected function setNamespace(string $namespace = ''): void
	{
		$this->namespace = WP_PLUGIN_SLUG;

        if ($namespace) {
            $this->namespace .= "/$namespace";
        }
	}

}
