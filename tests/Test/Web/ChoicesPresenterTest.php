<?php

namespace Test\Web;

use Configurator\Models\Choice;
use Configurator\Models\Option;

use PHPUnit\Framework\TestCase;

use Web\ChoicesPresenter;

class ChoicesPresenterTest extends TestCase
{
    public function testEmptyResponse()
    {
        $p = new ChoicesPresenter();
        $data = $p->present([], (object)['choices'=>[]]);
        $this->assertEquals([], $data['choices']);
    }

    public function testResponseWithChoice()
    {
        $p = new ChoicesPresenter();
        $result = $p->present([], (object)['choices' => [ new Choice("Kies je productiemethode", [], 'production') ] ]);
        $data = $result['choices'];
        $this->assertEquals(1, count($data));
        $this->assertEquals('Kies je productiemethode', $data[0]['title']);
        $this->assertEquals(1, $data[0]['id']);
        $this->assertEquals('production', $data[0]['name']);
        $this->assertEquals('choice[1]', $data[0]['param']);
        $this->assertEquals(true, $data[0]['open']);
        $this->assertEquals(false, $data[0]['selected']);
        $this->assertEquals('radio', $data[0]['type']);
        $this->assertEquals([], $data[0]['options']);
    }

    public function testResponseWithTwoChoices()
    {
        $p = new ChoicesPresenter();
        $result = $p->present([], (object)[
            'choices' => [
                new Choice("Kies je productiemethode", [
                    new Option("Digitaal drukwerk", 0, 0, 0),
                    new Option("Offset drukwerk", 0, 0, 0),
                ], 'production'),
                new Choice("Kies het eindformaat", [
                    new Option("A4", 0, 0, 0),
                    new Option("A5", 0, 0, 0),
                ], 'size') 
            ]
        ]);
        $data = $result['choices'];
        $this->assertEquals(2, count($data));
        $this->assertEquals(1, $data[0]['id']);
        $this->assertEquals(2, $data[1]['id']);
        $this->assertEquals('choice[1]', $data[0]['param']);
        $this->assertEquals('choice[2]', $data[1]['param']);
        $this->assertEquals(false, $data[1]['open']);
    }

    public function testResponseWithChoiceAndOption()
    {
        $p = new ChoicesPresenter();
        $result = $p->present([], (object)[
            'choices' => [
                new Choice("Kies je productiemethode", [
                    new Option("Digitaal drukwerk", 0, 0, 0),
                    new Option("Offset drukwerk", 0, 0, 0),
                ], 'production') 
            ]
        ]);
        $data = $result['choices'];
        $this->assertEquals([
            ['title' => 'Digitaal drukwerk', 'id' => 1],
            ['title' => 'Offset drukwerk', 'id' => 2],
        ], $data[0]['options']);
    }

    public function testResponseWithChoiceTypePageCount()
    {
        $p = new ChoicesPresenter();
        $result = $p->present([], (object)[
            'choices' => [
                new Choice("Aantal pagina\'s inclusief omslag", [
                ], 'page_count') 
            ]
        ]);
        $data = $result['choices'];
        $this->assertEquals('select', $data[0]['type']);
    }
}
