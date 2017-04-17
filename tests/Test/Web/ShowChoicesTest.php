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
        $this->assertGreaterThan(1, $r->getCounts());
    }

    public function testBuildRequestChoicesId()
    {
        $c = new ShowChoices();
        $r = $c->buildRequest(['choices_id' => 1]);
        $this->assertEquals(1, $r->getChoicesId());
    }

    public function testBuildRequestChoicesIdWithExtra()
    {
        $c = new ShowChoices();
        $r = $c->buildRequest(['choices_id' => 1, 'unused' => 1]);
        $this->assertEquals(1, $r->getChoicesId());
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
        $selection = $r->getSelection();
        $this->assertEquals([0 => 0, 1 => 1, 2 => 3], $selection);
    }
}
