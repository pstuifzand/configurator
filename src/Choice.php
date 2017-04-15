<?php
namespace Configurator;

class Choice
{
    public $selected;

    protected $options;
    protected $title;
    protected $name;

    public function __construct($title, $options, $name, $selected = null)
    {
        $this->title = $title;
        $this->options = $options;
        $this->name = $name;
        $this->selected = $selected;
    }

    public function calculate($count)
    {
        return new Result(
            $count,
            $this->options[$this->selected]->days,
            $this->options[$this->selected]->price*$count
        );
    }

    /**
    * Getter for options
    *
    * @return string
    */
    public function getOptions()
    {
        return $this->options;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSelectedOption()
    {
        return $this->options[$this->selected];
    }

    public function setSelected($selected)
    {
        $this->selected = $selected;
    
        return $this;
    }

    public function hasSelection()
    {
        return $this->selected !== null;
    }
}
