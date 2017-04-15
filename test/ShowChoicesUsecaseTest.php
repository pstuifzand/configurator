<?php
namespace Test;

use PHPUnit\Framework\TestCase;
use Configurator\ShowChoicesUsecase;
use Configurator\ChoicesGateway;
use Configurator\Choice;
use Configurator\Option;
use Configurator\Calculator;

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
            ->willReturn([new Choice("TEST", [new Option("TEST-A", 0, 0)], 'test')]);

        $calculator = new Calculator();
        $usecase = new ShowChoicesUsecase($mock, $calculator);
        $request = [
            'choices_id' => 1,
            'selection'  => ['0' => '0'],
            'counts'     => [100],
        ];

        $response = $usecase->execute($request);
        $this->assertEquals("TEST", $response->choices[0]->getTitle());
        $this->assertEquals("TEST-A", $response->choices[0]->getSelectedOption()->getTitle());
        $this->assertEquals(0, $response->result[0]->days);
        $this->assertEquals(0, $response->result[0]->totalPrice);
    }

    public function testAllSelectionShowCalculation()
    {
        $mock = $this->createMock(ChoicesGateway::class);
        $mock->method('getChoices')
            ->with(1)
            ->willReturn([new Choice("TEST", [new Option("TEST-A", 0, 0)], 'test')]);

        $calculator = new Calculator();
        $usecase = new ShowChoicesUsecase($mock, $calculator);
        $request = [
            'choices_id' => 1,
            'selection'  => ['0' => '0'],
            'counts'     => [50, 100, 250, 500, 1000],
        ];

        $response = $usecase->execute($request);
        $this->assertNotEmpty($response->result);
        $this->assertEquals(5, count($response->result));
    }

    public function testAllSelectedUseCalculator()
    {
        $choicesGateway = $this->createMock(ChoicesGateway::class);
        $choicesGateway->method('getChoices')
            ->with(1)
            ->willReturn([new Choice("TEST", [new Option("TEST-A", 1, 3)], 'test')]);

        $calculator = new Calculator();

        $usecase = new ShowChoicesUsecase($choicesGateway, $calculator);

        $request = [
            'choices_id' => 1,
            'selection'  => ['0' => '0'],
            'counts'     => [50, 100, 250, 500, 1000],
        ];

        $response = $usecase->execute($request);

        $this->assertEquals(50, $response->result[0]->count);
        $this->assertEquals(100, $response->result[1]->count);
        $this->assertEquals(250, $response->result[2]->count);
        $this->assertEquals(500, $response->result[3]->count);
        $this->assertEquals(1000, $response->result[4]->count);
    }

}
