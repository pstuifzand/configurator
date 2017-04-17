<?php
namespace Web;

class ChoicesPresenter
{
    private function convertOptions($options)
    {
        $result = [];

        $id = 1;

        foreach ($options as $option) {
            $result[] = [
                'title' => $option->getTitle(),
                'id'    => $id,
            ];
            $id++;
        }

        return $result;
    }

    private function convertChoice($choice, $id)
    {
        $options = $this->convertOptions($choice->getOptions());

        return [
            'id'       => $id,
            'title'    => $choice->getTitle(),
            'name'     => $choice->getName(),
            'param'    => sprintf('choice[%d]', $id),
            'open'     => $id == 1,
            'selected' => $choice->hasSelection(),
            'type'     => $choice->getName() == 'page_count' ? 'select' : 'radio',
            'options'  => $options,
            'current'  => '',
        ];
    }

    private function presentCalculation($results)
    {
        $calculation = [];

        foreach ($results as $result) {
            $calculation[] = [
                'days'  => $result->days,
                'count' => $result->count,
                'price' => '&euro; ' . number_format($result->totalPrice, 2, ',', ''),
            ];
        }

        return $calculation;
    }

    public function presentChoices($response)
    {
        $id = 1;
        $open = true;

        $data = [];

        foreach ($response->choices as $choice) {
            $last = $this->convertChoice($choice, $id);
            $last['open'] = $open;
            $data[] = $last;

            if ($open && !$last['selected']) {
                $open = false;
            }

            $id++;
        }

        return $data;
    }

    public function present($request, $response)
    {
        $data = $this->presentChoices($response);

        $calculation = isset($response->result) 
            ? $this->presentCalculation($response->result)
            : [];

        return [
            'choices' => $data,
            'result'  => $calculation,
        ];
    }
}
