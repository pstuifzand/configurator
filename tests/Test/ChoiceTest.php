<?php
use Configurator\Models\Choice;
use PHPUnit\Framework\TestCase;

class ChoiceTest extends TestCase
{
    public function testChoiceConstructor()
    {
        $choice = new Choice("Titel", [], 'titel');
        $this->assertEquals("Titel", $choice->getTitle());
        $this->assertEquals([], $choice->getOptions());
        $this->assertEquals('titel', $choice->getName());
    }
}
