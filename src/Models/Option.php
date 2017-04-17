<?php

namespace Configurator\Models;

class Option
{
    private $title;
    private $days;
    private $price;
    private $basePrice;

    /**
     * Option constructor.
     * @param $title string
     * @param $days int
     * @param $price float
     * @param $basePrice float
     */
    public function __construct(string $title, int $days, float $price, float $basePrice)
    {
        $this->title = $title;
        $this->days = $days;
        $this->price = $price;
        $this->basePrice = $basePrice;
    }

    /**
     * Getter for title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function calculate($count)
    {
        return new Result(
            $count,
            $this->days,
            $count > 0 ? $this->price * $count + $this->basePrice : 0
        );
    }
}
