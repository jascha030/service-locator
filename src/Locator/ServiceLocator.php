<?php

namespace Jascha030\WPOL\Service\Locator;

use Exception;

class ServiceLocator extends Locator
{
    private $services = [];

    /**
     * @param $key
     *
     * @return bool|mixed
     * @throws Exception
     */
    public function get($key)
    {
        if ($this->has($key)) {
            throw new Exception("Service does not exist or is not loaded in plugin");
        }

        return call_user_func($this->services[$key]);
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function has($key)
    {
        return (array_key_exists($key, $this->services));
    }

    /**
     * @return array
     */
    protected function getServices(): array
    {
        return $this->services;
    }

    /**
     * @param array $services
     */
    protected function setServices(array $services)
    {
        $this->services = $services;
    }
}
