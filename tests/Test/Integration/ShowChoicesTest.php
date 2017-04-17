<?php

namespace Test\Integration;

use Configurator\Gateway\MemoryChoicesGateway;
use Configurator\Util\Calculator;
use Configurator\Usecases\ShowChoices as Usecase;
use Web\ShowChoices;
use Web\ChoicesPresenter;

use PHPUnit\Framework\TestCase;

class ShowChoicesTest extends TestCase
{
    public function testFromUsecaseToPresenter()
    {
        $gateway = new MemoryChoicesGateway();
        $calculator = new Calculator();
        $usecase = new Usecase($gateway, $calculator);
        $request = (new ShowChoices())->buildRequest(['choices_id' => 1, 'selection' => []]);
        $response = $usecase->execute($request);
        $presenter = new ChoicesPresenter();
        $data = $presenter->present($request, $response);
        $this->assertArrayHasKey('choices', $data);
        $this->assertArrayHasKey('result', $data);
    }
}
