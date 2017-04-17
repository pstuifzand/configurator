<?php
namespace Configurator\Gateway;

interface ChoicesGateway
{
    /**
     * @param $choiceId int
     * @return \Configurator\Models\Choice[]
     */
    public function getChoices($choiceId);
}
