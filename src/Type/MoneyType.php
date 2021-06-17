<?php

namespace App\Type;

use App\Interfaces\DataTypeInterface;

class MoneyType implements DataTypeInterface
{
    private $currency;
    private $showDecimals;
    private $decSeparator;
    private $thousandsSep;
    private $roundMode;
    
    public function __construct(string $currency, bool $showDecimals = true, string $decSeparator = ',', string $thousandsSep = ' ', int $roundMode = PHP_ROUND_HALF_UP)
    {
        $this->currency = $currency;
        $this->showDecimals = $showDecimals;
        $this->decSeparator = $decSeparator;
        $this->thousandsSep = $thousandsSep;
        $this->roundMode = $roundMode;
    }
    
    public function format(string $value): string
    {
        $value = round($value, 2, $this->roundMode);
        return number_format((float)$value, 2, $this->decSeparator, $this->thousandsSep) . ' ' . $this->currency;
    }
    
    public function isValid(?string $value): bool
    {
        if ($value != null && strlen($value) > 0) {
            return filter_var((float)$value, FILTER_VALIDATE_FLOAT);
        }
        
        return false;
    }
}
