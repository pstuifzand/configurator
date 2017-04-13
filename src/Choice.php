<?php
namespace Configurator;

class Choice
{
    public $selected;

    protected $options;
    protected $title;

    public function __construct($title, $options, $selected = null)
    {
        $this->title = $title;
        $this->options = $options;
        $this->selected = $selected;
    }

    public function calculate($count)
    {
        return new Result(
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

    /**
     * Getter for title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function getSelectedOption()
    {
        return $this->options[$this->selected];
    }

    /**
     * Setter for selected
     *
     * @param string $selected
     * @return Choice
     */
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
