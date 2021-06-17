<?php

namespace App\Tests\Type;

use PHPUnit\Framework\TestCase;
use App\Type\MoneyType;

class MoneyTypeTest extends TestCase
{
    public function testMoneyType(): void
    {
        $stub = $this->createStub(MoneyType::class);
        $stub->method('format')
            ->willReturn("8 145,12 PLN");
        
        $this->assertSame("8 145,12 PLN", $stub->format("8145.12"));
    }
    
    public function testValidIfValid(): void
    {
        $stub = $this->createStub(MoneyType::class);
        $stub->method('isValid')
            ->willReturn(true);
        
        $this->assertSame(true, $stub->isValid("145.123"));
    }
    
    public function testValidIfInvalid(): void
    {
        $stub = $this->createStub(MoneyType::class);
        $stub->method('isValid')
            ->willReturn(false);
        
        $this->assertSame(false, $stub->isValid("145h.123"));
    }
    
    public function testValidIfNull(): void
    {
        $stub = $this->createStub(MoneyType::class);
        $stub->method('isValid')
            ->willReturn(false);
        
        $this->assertSame(false, $stub->isValid(null));
    }
}
