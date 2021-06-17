<?php

namespace App\Type;

use App\Interfaces\DataTypeInterface;

class IntegerType implements DataTypeInterface
{   
    public function format(string $value): string
    {
        return number_format($value, 0, '', '');
    }
    
    public function isValid(?string $value): bool
    {
        if ($value != null && strlen($value) > 0) {
            return filter_var($value, FILTER_VALIDATE_INT);
        }
        
        return false;
    }
}
