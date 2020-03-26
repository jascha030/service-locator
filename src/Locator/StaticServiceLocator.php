<?php

namespace Jascha030\WPOL\Service\Locator;

use Exception;

/**
 * Class StaticServiceLocator
 *
 * @package Jascha030\WPOL\Service\Locator
 */
class StaticServiceLocator extends Locator
{
    private static $services = [];

    /**
     * @param $key
     *
     * @return mixed
     * @throws Exception
     */
    public static function get($key)
    {
        /** @var StaticServiceLocator $class */
        $class = get_called_class();

        if ($class::has($key)) {
            throw new Exception("Service does not exist or is not loaded in plugin");
        }

        return call_user_func(self::$services[$key]);
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public static function has($key): bool
    {
        $class = get_called_class();

        return (array_key_exists($key, self::$services));
    }

    /**
     * @return array
     */
    protected function getServices(): array
    {
        return $this::$services;
    }

    /**
     * @param array $services
     */
    protected function setServices(array $services)
    {
        $this::$services = $services;
    }
}
