<?php

namespace Jascha030\WPOL\Service\Locator;

use Jascha030\WPOL\Service\Service;

abstract class Locator
{
    /**
     * Locator constructor.
     *
     * @param array $services
     */
    public function __construct($services = [])
    {
        $closures = [];
        $services = array_merge($this->getServices(), $services);

        foreach ($services as $service) {
            if (in_array(Service::class, class_implements($services))) {
                $closures[$service->getName()] = function () use ($service) {
                    static $_service;

                    if (null !== $_service) {
                        return $_service;
                    }

                    $_service = (is_string($service)) ? new $service() : $service;

                    return $_service;
                };
            }
        }

        $this->setServices($closures);
    }

    abstract protected function getServices(): array;

    abstract protected function setServices(array $services);
}
