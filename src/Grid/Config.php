<?php

namespace App\Grid;

use App\Interfaces\ConfigInterface;
use App\Interfaces\ColumnInterface;

abstract class Config implements ConfigInterface
{
    private $columns = [];
    
    public function addColumn(string $key, ColumnInterface $column): Config
    {
        if (!key_exists($key, $this->columns)) {
            $this->columns[$key] = $column;
        } else {
            throw new \Exception('Kolumna '.$key.' już istnieje');
        }
        
        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }
}
