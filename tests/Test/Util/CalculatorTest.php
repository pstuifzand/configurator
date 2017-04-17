<?php
namespace Test\Util;

use Configurator\Util\Calculator;
use Configurator\Models\Choice;
use Configurator\Models\Option;

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testNoChoices()
    {
        $choices = [];
        $c = new Calculator();
        $result = $c->calculate($choices, 100);

        $this->assertEquals(100, $result->count);
        $this->assertEquals(0, $result->days);
        $this->assertEquals(0, $result->totalPrice);
    }

    public function testOneChoice()
    {
        $choices = [
            new Choice("Kies de productiemethode", [
                new Option("Digitaal drukwerk", 1, 3, 0),
                new Option("Offset drukwerk", 3, 1, 0)
            ], 'production',0),
        ];

        $c = new Calculator();
        $result = $c->calculate($choices, 100);

        $this->assertEquals(1, $result->days);
        $this->assertEquals(300, $result->totalPrice);
    }

    public function testOneChoiceTwo()
    {
        $choices = [
            new Choice("Kies of productiemethode", [
                new Option("Digitaal drukwerk", 1, 3, 0),
                new Option("Offset drukwerk", 3, 1, 0)
            ], 'production', 1),
        ];

        $c = new Calculator();
        $result = $c->calculate($choices, 100);

        $this->assertEquals(3, $result->days);
        $this->assertEquals(100, $result->totalPrice);
    }

    public function testTwoChoiceFirst()
    {
        $choices = [
            new Choice("Kies of productiemethode", [
                new Option("Digitaal drukwerk", 1, 3, 0),
                new Option("Offset drukwerk", 3, 1, 0)
            ], 'production',0),
            new Choice("Kies het eindformaat", [
                new Option("A4", 0, 3, 0),
                new Option("A5", 0, 2, 0),
                new Option("A6", 0, 1, 0)
            ], 'production',0),
        ];

        $c = new Calculator();
        $result = $c->calculate($choices, 100);

        $this->assertEquals(1, $result->days);
        $this->assertEquals(100*(3+3), $result->totalPrice);
    }

    public function testTwoChoiceSecond()
    {
        $choices = [
            new Choice("Kies of productiemethode", [
                new Option("Digitaal drukwerk", 1, 3, 0),
                new Option("Offset drukwerk", 3, 1, 0)
            ], 'production',0),
            new Choice("Kies het eindformaat", [
                new Option("A4", 0, 3, 0),
                new Option("A5", 0, 2, 0),
                new Option("A6", 0, 1, 0)
            ], 'production',1),
        ];

        $c = new Calculator();
        $result = $c->calculate($choices, 100);

        $this->assertEquals(1, $result->days);
        $this->assertEquals(100*(3+2), $result->totalPrice);
    }
}

