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
            'open'     => $id == 1,
            'selected' => false,
            'type'     => $choice->getName() == 'page_count' ? 'select' : 'radio',
            'options'  => $options,
        ];
    }

    public function present($request, $response)
    {
        $data = [];

        $id = 1;
        foreach ($response->choices as $choice) {
            $data[] = $this->convertChoice($choice, $id);
            $id++;
        }

        return $data;
    }
}
