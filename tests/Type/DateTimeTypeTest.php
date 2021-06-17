<?php

namespace App\Tests\Type;

use PHPUnit\Framework\TestCase;
use App\Type\DateTimeType;

class DateTimeTypeTest extends TestCase
{
    public function testDateType(): void
    {
        $stub = $this->createStub(DateTimeType::class);
        $stub->method('format')
            ->willReturn("13.02.2020 15:30");
        
        $this->assertSame("13.02.2020 15:30", $stub->format("15:30 13.02.2020"));
    }
    
    public function testValidIfValid(): void
    {
        $stub = $this->createStub(DateTimeType::class);
        $stub->method('isValid')
            ->willReturn(true);
        
        $this->assertSame(true, $stub->isValid("15.04.2020 15:30 "));
    }
    
    public function testValidIfInvalid(): void
    {
        $stub = $this->createStub(DateTimeType::class);
        $stub->method('isValid')
            ->willReturn(false);
        
        $this->assertSame(false, $stub->isValid("32.04.2020"));
    }
    
    public function testValidIfNull(): void
    {
        $stub = $this->createStub(DateTimeType::class);
        $stub->method('isValid')
            ->willReturn(false);
        
        $this->assertSame(false, $stub->isValid(null));
    }
}
