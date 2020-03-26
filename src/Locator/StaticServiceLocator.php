<?php

namespace Jascha030\WPOL\Service\Locator;

use Exception;

class StaticLocator
{
    private static $instance;

    private static $services = [];

    public function __construct()
    {
        foreach ($this::$services as $service) {
            if (class_exists($service)) {
                $this[$service] = function () use ($service) {
                    static $_service;

                    if (null !== $_service) {
                        return $_service;
                    }

                    $_service = (is_string($service)) ? new $service() : $service;

                    return $_service;
                };
            }
        }
    }

    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function get($key)
    {
        $class = get_called_class();

        if ($class::has($key)) {
            throw new Exception("Service does not exist or is not loaded in plugin");
        }

        return call_user_func($class::services[$key]);
    }

    public static function has($key)
    {
        $class = get_called_class();

        return (array_key_exists($key, $class::$services));
    }
}
