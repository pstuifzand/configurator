<?php
namespace Configurator;

class ShowChoicesUsecase
{
    protected $choicesGateway;

    public function __construct(ChoicesGateway $choicesGateway)
    {
        $this->choicesGateway = $choicesGateway;
    }

    public function execute($request)
    {
        $response = new \stdclass;
        $response->choices = $this->choicesGateway->getChoices($request['choices_id']);
        foreach ($request['selection'] as $i => $selected) {
            $response->choices[$i]->setSelected($selected);
        }
        $response->result = new Result(0, 0);
        return $response;
    }
}
