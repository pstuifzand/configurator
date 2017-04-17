<?php

namespace Configurator\Util;

use Configurator\Models\Result;

class Calculator
{
    /**
     * @param $choices  \Configurator\Models\Choice[]
     * @param $count    int
     * @return Result
     */
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

