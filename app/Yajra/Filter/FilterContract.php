<?php

namespace App\Yajra\Filter;

interface FilterContract
{
    public function __invoke($query, $keyword): void;
}