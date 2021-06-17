<?php

namespace App\Grid;

use App\Grid\Column;
use App\Type\IntegerType;
use App\Type\TextType;
use App\Type\MoneyType;
use App\Type\DateType;
use App\Type\DateTimeType;

final class DefaultConfig extends Config
{
    public function addIntColumn(string $key, string $label): DefaultConfig
    {
        $column = (new Column())
            ->withLabel($label)
            ->withDataType(new IntegerType())
            ->withAlign('right');
        
        $this->addColumn($key, $column);
        
        return $this;
    }
    
    public function addTextColumn(string $key, string $label): DefaultConfig
    {
        $column = (new Column())
            ->withLabel($label)
            ->withDataType(new TextType())
            ->withAlign('left');
        
        $this->addColumn($key, $column);
        
        return $this;
    }
    
    public function addCurrencyColumn(string $key, string $label, string $currency): DefaultConfig
    {
        $column = (new Column())
            ->withLabel($label)
            ->withDataType(new MoneyType($currency))
            ->withAlign('right');
        
        $this->addColumn($key, $column);
        
        return $this;
    }
    
    public function addDateColumn(string $key, string $label): DefaultConfig
    {
        $column = (new Column())
            ->withLabel($label)
            ->withDataType(new DateType())
            ->withAlign('left');
        
        $this->addColumn($key, $column);
        
        return $this;
    }
    
    public function addDateTimeColumn(string $key, string $label): DefaultConfig
    {
        $column = (new Column())
            ->withLabel($label)
            ->withDataType(new DateTimeType())
            ->withAlign('left');
        
        $this->addColumn($key, $column);
        
        return $this;
    }
}
