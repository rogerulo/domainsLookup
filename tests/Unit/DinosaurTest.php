<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DinosaurTest extends TestCase
{
    public function testSettingLength()
    {
        $dinosaur = new Dinosaur();
        $this->assertSame(0, $dinosaur->getLength());
        $dinosaur->setLength(9);
        $this->assertSame(9, $dinosaur->getLength());
    }
}
