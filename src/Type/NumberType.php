<?php

namespace App\Type;

use App\Interfaces\DataTypeInterface;

class NumberType implements DataTypeInterface
{
    private $precision;
    private $decSeparator;
    private $thousandsSep;
    private $roundMode;
    
    public function __construct(int $precision = 2, string $decSeparator = ',', string $thousandsSep = ' ', int $roundMode = PHP_ROUND_HALF_UP)
    {
        $this->precision = $precision;
        $this->decSeparator = $decSeparator;
        $this->thousandsSep = $thousandsSep;
        $this->roundMode = $roundMode;
    }
    
    public function format(string $value): string
    {
        $value = round($value, $this->precision, $this->roundMode);
        return number_format((float) $value, $this->precision, $this->decSeparator, $this->thousandsSep);
    }
    
    public function isValid(?string $value): bool
    {
        if ($value != null && strlen($value) > 0) {
            return filter_var((float)$value, FILTER_VALIDATE_FLOAT);
        }
        
        return false;
    }
}
