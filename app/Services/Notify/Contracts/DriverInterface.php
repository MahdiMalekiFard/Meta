<?php

namespace App\Services\Notify\Contracts;

interface DriverInterface
{
    /**
     * Each driver must be named (for logging/debugging)
     */
    public function name(): string;
}
