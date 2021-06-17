<?php

namespace App\Grid;

use App\Grid\Cell;

class Row
{
    private $cells = [];
    private $isValid;
    
    public function addCell(string $key, Cell $cell): Row
    {
        $this->cells[$key] = $cell;
        
        return $this;
    }
    
    public function getCells(): array
    {
        return $this->cells;
    }
    
    public function isValid()
    {
        if ($this->isValid == null) {
            foreach ($this->cells as $cell) {
                if ($cell->isValid()) {
                    $this->isValid = true;
                    
                    return $this->isValid;
                }
            }
        }
        
        return false;
    }
}
