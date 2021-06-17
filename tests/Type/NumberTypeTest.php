<?php

namespace App\Tests\Type;

use PHPUnit\Framework\TestCase;
use App\Type\NumberType;

class NumberTypeTest extends TestCase
{
    public function testNumberType(): void
    {
        $stub = $this->createStub(NumberType::class);
        $stub->method('format')
            ->willReturn("145.12");
        
        $this->assertSame("145.12", $stub->format("145.123"));
    }
    
    public function testValidIfValid(): void
    {
        $stub = $this->createStub(NumberType::class);
        $stub->method('isValid')
            ->willReturn(true);
        
        $this->assertSame(true, $stub->isValid("145.123"));
    }
    
    public function testValidIfInvalid(): void
    {
        $stub = $this->createStub(NumberType::class);
        $stub->method('isValid')
            ->willReturn(false);
        
        $this->assertSame(false, $stub->isValid("145h.123"));
    }
    
    public function testValidIfNull(): void
    {
        $stub = $this->createStub(NumberType::class);
        $stub->method('isValid')
            ->willReturn(false);
        
        $this->assertSame(false, $stub->isValid(null));
    }
}
