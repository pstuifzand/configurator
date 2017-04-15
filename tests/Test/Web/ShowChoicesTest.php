<?php
namespace Test\Web;

use PHPUnit\Framework\TestCase;

use Web\ShowChoices;

class ShowChoicesTest extends TestCase
{
    public function testBuildRequestEmpty_hasCounts()
    {
        $c = new ShowChoices();
        $r = $c->buildRequest([]);
        $this->assertArrayHasKey('counts', $r);
    }

    public function testBuildRequestChoicesId()
    {
        $c = new ShowChoices();
        $r = $c->buildRequest(['choices_id' => 1]);
        $this->assertEquals(1, $r['choices_id']);
    }

    public function testBuildRequestChoicesIdWithExtra()
    {
        $c = new ShowChoices();
        $r = $c->buildRequest(['choices_id' => 1, 'unused' => 1]);
        $this->assertEquals(1, $r['choices_id']);
        $this->assertArrayHasKey('counts', $r);
        $this->assertEquals(2, count($r));
    }

    public function testBuildRequestSelection()
    {
        $c = new ShowChoices();
        $r = $c->buildRequest([
            'choices_id' => 1,
            'choice' => [
                1 => 1,
                2 => 2,
                3 => 4,
            ]
        ]);
        $this->assertEquals(0, $r['selection'][0]);
        $this->assertEquals(1, $r['selection'][1]);
        $this->assertEquals(3, $r['selection'][2]);
    }
}
