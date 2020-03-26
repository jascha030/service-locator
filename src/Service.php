<?php

namespace Jascha030\Service;

/**
 * Interface Service
 *
 * @package Jascha030\Service
 */
interface Service
{
    /**
     * Service constructor.
     *
     * Make sure no arguments are needed
     */
    public function __construct();

    public function getName(): string;
}
