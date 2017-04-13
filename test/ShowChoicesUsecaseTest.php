<?php
namespace Test;

use PHPUnit\Framework\TestCase;
use Configurator\ShowChoicesUsecase;
use Configurator\ChoicesGateway;
use Configurator\Choice;
use Configurator\Option;

class ShowChoicesUsecaseTest extends TestCase
{
    public function testUsecaseNoChoices()
    {
        $mock = $this->createMock(ChoicesGateway::class);
        $mock->method('getChoices')
             ->willReturn([]);

        $usecase = new ShowChoicesUsecase($mock);
        $request = [
            'choices_id' => 1,
            'selection'  => [],
        ];

        $response = $usecase->execute($request);
        $this->assertEquals([], $response->choices);
    }

    public function testUsecaseOneChoice()
    {
        $mock = $this->createMock(ChoicesGateway::class);
        $mock->expects($this->once())
            ->method('getChoices')
            ->with(1);

        $usecase = new ShowChoicesUsecase($mock);
        $request = [
            'choices_id' => 1,
            'selection'  => [],
        ];

        $response = $usecase->execute($request);
    }

    public function testUsecaseOneChoiceSelection()
    {
        $mock = $this->createMock(ChoicesGateway::class);
        $mock->method('getChoices')
            ->with(1)
            ->willReturn([new Choice("TEST", [new Option("TEST-A", 0, 0)])]);

        $usecase = new ShowChoicesUsecase($mock);
        $request = [
            'choices_id' => 1,
            'selection'  => ['0' => '0'],
        ];

        $response = $usecase->execute($request);
        $this->assertEquals("TEST", $response->choices[0]->getTitle());
        $this->assertEquals("TEST-A", $response->choices[0]->getSelectedOption()->getTitle());
        $this->assertEquals(0, $response->result->days);
        $this->assertEquals(0, $response->result->totalPrice);
    }
}
