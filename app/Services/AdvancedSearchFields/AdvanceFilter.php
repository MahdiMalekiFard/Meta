<?php

namespace App\Services\AdvancedSearchFields;

use App\Helpers\StringHelper;
use App\Helpers\Utils;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class AdvanceFilter implements Filter
{
    public function __construct()
    {
    }
    
    /**
     * @throws Exception
     */
    public function __invoke(Builder $query,$value, string $property): void
    {
        $handler = app("App\\Services\\AdvancedSearchFields\\Drivers\\" . StringHelper::convertToClassName(Utils::getKeyFromEloquent($query->getModel()::class)) . "Driver");
        $handler->handle($query, $value);
    }
}
