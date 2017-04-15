<?php
require __DIR__ . "/../vendor/autoload.php";

use Configurator\MemoryChoicesGateway;
use Configurator\ShowChoicesUsecase;

use Web\ChoicesPresenter;

$gateway = new MemoryChoicesGateway();
$usecase = new ShowChoicesUsecase($gateway);

$request = [
    'choices_id' => 1,
    'selection'  => [],
];

$response = $usecase->execute($request);

$presenter = new ChoicesPresenter();

$data = $presenter->present($request, $response);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://localhost:8001");
echo json_encode($data);
