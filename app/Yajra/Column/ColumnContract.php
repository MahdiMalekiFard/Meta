<?php

namespace App\Yajra\Column;

interface ColumnContract
{
    public function __invoke($row);
}