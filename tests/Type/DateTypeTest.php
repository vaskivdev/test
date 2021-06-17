<?php

namespace App\Tests\Type;

use PHPUnit\Framework\TestCase;
use App\Type\DateType;

class DateTypeTest extends TestCase
{
    public function testDateType(): void
    {
        $stub = $this->createStub(DateType::class);
        $stub->method('format')
            ->willReturn("13.02.2020");
        
        $this->assertSame("13.02.2020", $stub->format("13.02.2020"));
    }
    
    public function testValidIfValid(): void
    {
        $stub = $this->createStub(DateType::class);
        $stub->method('isValid')
            ->willReturn(true);
        
        $this->assertSame(true, $stub->isValid("15.04.2020"));
    }
    
    public function testValidIfInvalid(): void
    {
        $stub = $this->createStub(DateType::class);
        $stub->method('isValid')
            ->willReturn(false);
        
        $this->assertSame(false, $stub->isValid("32.04.2020"));
    }
    
    public function testValidIfNull(): void
    {
        $stub = $this->createStub(DateType::class);
        $stub->method('isValid')
            ->willReturn(false);
        
        $this->assertSame(false, $stub->isValid(null));
    }
}
