<?php
namespace Configurator;

class Result
{
    public $days;
    public $totalPrice;

    public function __construct($days, $price)
    {
        $this->days = $days;
        $this->totalPrice = $price;
    }

    public function combine($right) {

        return new Result(
            $this->days + $right->days,
            $this->totalPrice + $right->totalPrice
        );
    }
}
