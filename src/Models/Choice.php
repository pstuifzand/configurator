<?php
namespace Configurator\Models;

class Choice
{
    private $selected;

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

    /**
     * @return Result
     */
    public function calculate($count)
    {
        if (is_null($this->selected)) {
            return new Result($count, 0, 0);
        }

        $option = $this->options[$this->selected];
        return $option->calculate($count);
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
