<?php
namespace Configurator\Usecases;

use Configurator\Util\Calculator;
use Configurator\Gateway\ChoicesGateway;

use Configurator\Models;
use Configurator\Usecases\ShowChoices\Request;

class ShowChoices
{
    protected $choicesGateway;
    protected $calculator;

    public function __construct(ChoicesGateway $choicesGateway, Calculator $calculator = null)
    {
        $this->choicesGateway = $choicesGateway;
        $this->calculator = $calculator;
    }

    public function execute(Request $request)
    {
        $selection = $request->getSelection();
        $counts    = $request->getCounts();
        $choicesId = $request->getChoicesId();

        $choices = $this->getChoices($choicesId, $selection);

        $response = new \stdclass;
        $response->choices = $choices;

        if (!is_null($this->calculator)) {
            $calcResult = [];
            foreach ($counts as $count) {
                $result = $this->calculator->calculate($response->choices, $count);
                $calcResult[] = $result;
            }
            $response->result = $calcResult;
        }

        return $response;
    }

    /**
     * @param $choiceId
     * @param $selection
     * @return Models\Choice|Models\Choice[]
     */
    private function getChoices($choiceId, $selection): array
    {
        $choices = $this->choicesGateway->getChoices($choiceId);
        if ($choices == null) return [];

        foreach ($selection as $i => $selected) {
            $choices[$i]->setSelected($selected);
        }

        return $choices;
    }
}
