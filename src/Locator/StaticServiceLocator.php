<?php

namespace Jascha030\Service\Locator;

use Exception;
use Jascha030\Service\Exception\ServiceNotFoundException;

/**
 * Class StaticServiceLocator
 *
 * @package Jascha030\Service\Locator
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
        if (self::has($key)) {
            throw new ServiceNotFoundException("Service does not exist or is not loaded in plugin");
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
