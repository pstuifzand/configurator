<?php
namespace Web;
use Configurator\Usecases\ShowChoices\Request;

class ShowChoices
{
    public function buildRequest($get)
    {
        $options = [
            'choices_id' => $get['choices_id'] ?? null,
            'selection'  => isset($get['choice']) ? $get['choice'] : [],
        ];
        $request = new Request($options);

        $request->setCounts([50, 100, 250, 500, 1000]);

        return $request;
    }
}

