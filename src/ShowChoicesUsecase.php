<?php
namespace Configurator;

class ShowChoicesUsecase
{
    protected $choicesGateway;
    protected $calculator;

    public function __construct(ChoicesGateway $choicesGateway, Calculator $calculator = null)
    {
        $this->choicesGateway = $choicesGateway;
        $this->calculator = $calculator;
    }

    public function execute($request)
    {
        $response = new \stdclass;
        $response->choices = $this->choicesGateway->getChoices($request['choices_id']);
        foreach ($request['selection'] as $i => $selected) {
            $response->choices[$i]->setSelected($selected);
        }
        $request['counts'] = isset($request['counts']) ? $request['counts'] : [];

        if (!is_null($this->calculator)) {
            $response->result = [];
            foreach ($request['counts'] as $count) {
                $response->result[] = $this->calculator->calculate($response->choices, $count);
            }
        }

        return $response;
    }
}
