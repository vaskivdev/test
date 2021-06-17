<?php

namespace App\Tests\Type;

use PHPUnit\Framework\TestCase;
use App\Type\IntegerType;

class IntegerTypeTest extends TestCase
{
    public function testIntegerType(): void
    {
        $stub = $this->createStub(IntegerType::class);
        $stub->method('format')
            ->willReturn("145");
        
        $this->assertSame("145", $stub->format("145.123"));
    }
    
    public function testValidIfValid(): void
    {
        $stub = $this->createStub(IntegerType::class);
        $stub->method('isValid')
            ->willReturn(true);
        
        $this->assertSame(true, $stub->isValid("145"));
    }
    
    public function testValidIfInvalid(): void
    {
        $stub = $this->createStub(IntegerType::class);
        $stub->method('isValid')
            ->willReturn(false);
        
        $this->assertSame(false, $stub->isValid("145.123"));
    }
    
    public function testValidIfNull(): void
    {
        $stub = $this->createStub(IntegerType::class);
        $stub->method('isValid')
            ->willReturn(false);
        
        $this->assertSame(false, $stub->isValid(null));
    }
}
