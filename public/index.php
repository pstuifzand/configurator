<?php
require __DIR__ . "/../vendor/autoload.php";

use Configurator\Util\Calculator;
use Configurator\Gateway\MemoryChoicesGateway;
use Configurator\Usecases\ShowChoices as Usecase;
use Web\ChoicesPresenter;
use Web\ShowChoices;

$gateway = new MemoryChoicesGateway();
$calculator = new Calculator();
$usecase = new Usecase($gateway, $calculator);

$request = (new ShowChoices())->buildRequest($_GET);
$response = $usecase->execute($request);

$presenter = new ChoicesPresenter();

$data = $presenter->present($request, $response);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://localhost:8001");
echo json_encode($data);
