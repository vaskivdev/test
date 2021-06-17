<?php

namespace App\Grid;

use App\Interfaces\ColumnInterface;
use App\Interfaces\DataTypeInterface;

class Column implements ColumnInterface
{
    private $label;
    private $dataType;
    
    public function withLabel(string $label): Column
    {
        $this->label = $label;
        
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function withDataType(DataTypeInterface $dataType): ColumnInterface
    {
        $this->dataType = $dataType;
        
        return $this;
    }

    public function getDataType(): DataTypeInterface
    {
        return $this->dataType;
    }

    public function withAlign(string $align): ColumnInterface
    {
        $this->align = (in_array($align, ['center', 'left', 'right', 'justify'])) ? $align : 'left';
        
        return $this;
    }

    public function getAlign(): string
    {
        return $this->align;
    }
}
