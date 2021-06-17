<?php

namespace App\Type;

use App\Interfaces\DataTypeInterface;

class DateTimeType implements DataTypeInterface
{
    private $format;
    
    public function __construct($format = 'd.m.Y H:i:s')
    {
        $this->format = $format;
    }
    
    public function format(string $value): string
    {
        $date = new \DateTime($value);
        return $date->format($this->format);
    }
    
    public function isValid(?string $value): bool
    {
        if ($value != null && strlen($value) > 0) {
            return strtotime($value) != null;
        }
        
        return false;
    }
}
