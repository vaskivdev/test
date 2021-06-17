<?php

namespace App\Interfaces;

interface DataTypeInterface
{
    /**
     * Formatuje dane dla danego typu.
     */
    public function format(string $value): string;
    
    public function isValid(?string $value): bool;
}
