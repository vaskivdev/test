<?php

namespace App\Interfaces;
    
interface RowInterface
{
    public function setValid(bool $valid): RowInterface;

    public function getValid(): bool;
    
    public function setCell(bool $valid): RowInterface;

    public function getCell(): bool;
}
