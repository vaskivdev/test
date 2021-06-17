<?php

namespace App\Type;

use App\Interfaces\DataTypeInterface;
    
class TextType implements DataTypeInterface
{
    public function format(string $value): string
    {
        return filter_var(strip_tags($value), FILTER_SANITIZE_SPECIAL_CHARS);
    }
    
    public function isValid(?string $value): bool
    {
        if ($value != null && strlen($value) > 0) {
            return true;
        }
        
        return false;
    }
}
