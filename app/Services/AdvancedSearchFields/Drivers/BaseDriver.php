<?php

namespace App\Services\AdvancedSearchFields\Drivers;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

abstract class BaseDriver
{
    protected array  $fillable_columns = [];
    protected string $table            = "";
    
    public abstract function handle(Builder $query, array $values): Builder;
    
    public function filter(Builder $query, array $values): Builder
    {
        $this->table = $query->getModel()->getTable() . '.';
        $this->fillable_columns = array_merge($query->getModel()->getFillable(), ["id", "created_at"]);
        foreach ($values as $item) {
            if (!empty($item['from']) && $item['from'] !== 0) {
                if (!in_array($item['column'], $this->fillable_columns, true)) {
                    continue;
                }
                $this->addQuery($query, $item, $this->table);
            }
        }
        return $query;
    }
    
    /**
     * @param Builder                                                                 $query
     * @param array{contain:bool,column:string,operator:string,from:string,to:string} $item $item
     * @param                                                                         $table
     *
     * @return void
     */
    public function addQuery(Builder $query, array $item, $table = null): void
    {
        if (!isset($item['contain']) || empty($item['from']) || empty($item['operator']) || empty($item['column'])) {
            return;
        }
        
        if ($item['contain']) {
            if ($item['operator'] === 'between' && $item['to'] !== null) {
                $query->whereBetween($table . $item['column'], [$item['from'], $item['to']]);
            } else {
                if ($item['operator'] === 'like') {
                    $query->where($table . $item['column'], $item['operator'], "%" . $item['from'] . "%");
                } else {
                    if ($item['operator'] === 'in') {
                        $query->whereIn($table . $item['column'], $item['from']);
                    } else {
                        $query->where($table . $item['column'], $item['operator'], $item['from']);
                    }
                }
            }
        } else {
            if ($item['operator'] === 'between' && $item['to'] !== null) {
                $query->whereNotBetween($table . $item['column'], [$item['from'], $item['to']]);
            } else {
                if ($item['operator'] === 'like') {
                    $query->whereNot($table . $item['column'], $item['operator'], "%" . $item['from'] . "%");
                } else {
                    $query->whereNot($table . $item['column'], $item['operator'], $item['from']);
                }
            }
        }
    }
    
    protected function extraFilter($filters):Collection
    {
        return collect($filters)->whereNotIn('column', $this->fillable_columns)->reject(function ($item) {
            return !isset($item['contain'], $item['from']) || $item['from']==='' || empty($item['operator']) || empty($item['column']);
        });
    }
}
