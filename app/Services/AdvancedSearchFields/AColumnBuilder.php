<?php

namespace App\Services\AdvancedSearchFields;

class AColumnBuilder
{
    private string       $column;
    private string|array|null $from;
    private string|array|null $to;
    private string       $operator;
    private bool         $contain;
    
    public function __construct(string $column, string|array|null $from, string|array|null $to, $operator = '=', bool $contain = true)
    {
        $this->column = $column;
        $this->operator = $operator;
        $this->contain = $contain;
        $this->from = $from;
        $this->to = $to;
    }
    
    public static function new(string $column, $from, $to = null): static
    {
        return new static($column, $from, $to);
    }
    
    public function getColumn(): string
    {
        return $this->column;
    }
    
    public function setColumn(string $column): static
    {
        $this->column = $column;
        return $this;
    }
    
    public function getValue(): string|array|null
    {
        return $this->value;
    }
    
    public function setValue(string|array|null $value): static
    {
        $this->value = $value;
        return $this;
    }
    
    public function getOperator(): string
    {
        return $this->operator;
    }
    
    public function setOperator(string $operator): static
    {
        $this->operator = $operator;
        return $this;
    }
    
    public function isContain(): bool
    {
        return $this->contain;
    }
    
    public function setContain(bool $contain): static
    {
        $this->contain = $contain;
        return $this;
    }
    
    public function generate(): array
    {
        return [
            'column'   => $this->column,
            'from'     => $this->from,
            'to'       => $this->to,
            'operator' => $this->operator,
            'contain'  => $this->contain,
        ];
    }
}