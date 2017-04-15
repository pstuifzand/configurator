<?php

namespace Configurator;

class Calculator
{
    public function calculate($choices, $count)
    {
        $total = new Result($count, 0, 0);

        foreach ($choices as $choice) {
            $result = $choice->calculate($count);
            $total = $total->combine($result);
        }

        return $total;
    }
}

