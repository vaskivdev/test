<?php

namespace App\Grid;

use App\Grid\Column;

class Cell
{
    private $value;
    private $relatedColumn;
    private $isValid;

    public function __construct($value, Column $relatedColumn)
    {
        $this->value = $value;
        $this->relatedColumn = $relatedColumn;
        $this->isValid = $this->validate();
    }
    
    public function getValue(): ?string
    {
        if ($this->relatedColumn != null) {
            return $this->relatedColumn->getDataType()->format($this->value);
        }
        
        return null;
    }
    
    public function validate() {
        if ($this->relatedColumn != null) {
            return $this->relatedColumn->getDataType()->isValid($this->value);
        }
        
        return false;
    }
    
    public function isValid() {
        return $this->isValid;
    }
    
    public function getRelatedColumn(): Column
    {
        return $this->relatedColumn;
    }
    
    public function __toString(): string
    {
        return $this->getValue();
    }
}
