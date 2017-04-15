<?php
namespace Configurator;

class Result
{
    public $count;
    public $days;
    public $totalPrice;

    public function __construct($count, $days, $price)
    {
        $this->count = $count;
        $this->days = $days;
        $this->totalPrice = $price;
    }

    public function combine($right) {

        return new Result(
            $this->count,
            $this->days + $right->days,
            $this->totalPrice + $right->totalPrice
        );
    }
}
