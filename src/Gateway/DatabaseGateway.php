<?php

namespace Configurator\Gateway;

class DatabaseGateway implements ChoicesGateway
{
    public function __construct()
    {
    }

    public function getChoices($choiceId)
    {
        return [];
    }
}