<?php

namespace Configurator;

class Option
{
    public $title;
    public $days;
    public $price;

    public function __construct($title, $days, $price)
    {
        $this->title = $title;
        $this->days = $days;
        $this->price = $price;
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
}
