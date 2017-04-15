<?php
use PHPUnit\Framework\TestCase;
use Web\ChoicesPresenter;
use Configurator\Choice;
use Configurator\Option;

class ChoicesPresenterTest extends TestCase
{
    public function testEmptyResponse()
    {
        $p = new ChoicesPresenter();
        $data = $p->present([], (object)['choices'=>[]]);
        $this->assertEquals([], $data);
    }

    public function testResponseWithChoice()
    {
        $p = new ChoicesPresenter();
        $data = $p->present([], (object)['choices' => [ new Choice("Kies je productiemethode", [], 'production') ] ]);
        $this->assertEquals(1, count($data));
        $this->assertEquals('Kies je productiemethode', $data[0]['title']);
        $this->assertEquals(1, $data[0]['id']);
        $this->assertEquals('production', $data[0]['name']);
        $this->assertEquals(true, $data[0]['open']);
        $this->assertEquals(false, $data[0]['selected']);
        $this->assertEquals('radio', $data[0]['type']);
        $this->assertEquals([], $data[0]['options']);
    }

    public function testResponseWithTwoChoices()
    {
        $p = new ChoicesPresenter();
        $data = $p->present([], (object)[
            'choices' => [
                new Choice("Kies je productiemethode", [
                    new Option("Digitaal drukwerk", 0, 0),
                    new Option("Offset drukwerk", 0, 0),
                ], 'production'),
                new Choice("Kies het eindformaat", [
                    new Option("A4", 0, 0),
                    new Option("A5", 0, 0),
                ], 'size') 
            ]
        ]);
        $this->assertEquals(2, count($data));
        $this->assertEquals(1, $data[0]['id']);
        $this->assertEquals(2, $data[1]['id']);
        $this->assertEquals(false, $data[1]['open']);
    }

    public function testResponseWithChoiceAndOption()
    {
        $p = new ChoicesPresenter();
        $data = $p->present([], (object)[
            'choices' => [
                new Choice("Kies je productiemethode", [
                    new Option("Digitaal drukwerk", 0, 0),
                    new Option("Offset drukwerk", 0, 0),
                ], 'production') 
            ]
        ]);
        $this->assertEquals([
            ['title' => 'Digitaal drukwerk', 'id' => 1],
            ['title' => 'Offset drukwerk', 'id' => 2],
        ], $data[0]['options']);
    }

    public function testResponseWithChoiceTypePageCount()
    {
        $p = new ChoicesPresenter();
        $data = $p->present([], (object)[
            'choices' => [
                new Choice("Aantal pagina\'s inclusief omslag", [
                ], 'page_count') 
            ]
        ]);
        $this->assertEquals('select', $data[0]['type']);
    }
}
