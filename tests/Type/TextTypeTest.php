<?php

namespace App\Tests\Type;

use PHPUnit\Framework\TestCase;
use App\Type\TextType;

class TextTypeTest extends TestCase
{
    public function testTextType(): void
    {
        $stub = $this->createStub(TextType::class);
        $stub->method('format')
            ->willReturn('some string');
        
        $this->assertSame('some string', $stub->format('some string'));
    }
    
    public function testRemoveHtml(): void
    {
        $stub = $this->createStub(TextType::class);
        $stub->method('format')
            ->willReturn('Celina Collins');
        
        $this->assertSame('Celina Collins', $stub->format('<h1>Celina Collins</h1>'));
    }
}
