<?php

namespace Test;

use Configurator\Models\Option;
use PHPUnit\Framework\TestCase;

class OptionTest extends TestCase
{
    public function testCalculate_WithCountNoBase()
    {
        $o = new Option("Test", 1, 10, 0);
        $this->assertEquals(0, $o->calculate(0)->totalPrice);
        $this->assertEquals(10, $o->calculate(1)->totalPrice);
        $this->assertEquals(100, $o->calculate(10)->totalPrice);
    }

    public function testCalculate_WithBase()
    {
        $o = new Option("Test", 1, 10, 20);
        $this->assertEquals(0, $o->calculate(0)->totalPrice);
        $this->assertEquals(30, $o->calculate(1)->totalPrice);
        $this->assertEquals(270, $o->calculate(25)->totalPrice);
    }

    public function testResult_WithCount()
    {
        $o = new Option("Test", 1, 10, 20);
        $this->assertEquals(0, $o->calculate(0)->count);
        $this->assertEquals(100, $o->calculate(100)->count);
    }
}
