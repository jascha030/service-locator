<?php

namespace Jascha030\WPOL\Service;

/**
 * Interface Service
 *
 * @package Jascha030\WPOL\Service
 */
interface Service
{
    /**
     * Service constructor.
     *
     * Make sure no arguments are needed
     */
    public function __construct();

    public function getName();
}
