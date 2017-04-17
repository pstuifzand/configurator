<?php


namespace Configurator\Usecases\ShowChoices;


class Request
{
    protected $choicesId = null;
    protected $selection = [];
    protected $counts = [];

    public function __construct($options = [])
    {
        $this->choicesId = $options['choices_id'] ?? null;
        $selection = [];
        if (isset($options['selection'])) {
            foreach ($options['selection'] as $id => $optionId) {
                $selection[$id - 1] = $optionId - 1;
            }
        }
        $this->setSelection($selection);
        $this->setCounts($options['counts'] ?? []);
    }

    /**
     * @param int $choicesId
     */
    public function setChoicesId($choicesId)
    {
        $this->choicesId = $choicesId;
    }

    /**
     * @return int
     */
    public function getChoicesId()
    {
        return $this->choicesId;
    }

    /**
     * @param int[] $counts
     */
    public function setCounts($counts)
    {
        $this->counts = $counts;
    }

    /**
     * @return array
     */
    public function getCounts()
    {
        return $this->counts;
    }

    /**
     * @param array $selection
     */
    public function setSelection($selection)
    {
        $this->selection = $selection;
    }

    /**
     * @return array
     */
    public function getSelection()
    {
        return $this->selection;
    }
}