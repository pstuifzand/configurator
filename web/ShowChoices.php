<?php
namespace Web;

class ShowChoices
{
    public function buildRequest($get)
    {
        $result = [];
        if (isset($get['choices_id'])) {
            $result['choices_id'] = $get['choices_id'];
        }

        if (isset($get['choice'])) {
            foreach ($get['choice'] as $id => $optionId) {
                $result['selection'][$id-1] = $optionId-1;
            }
        }

        $result['counts'] = [50, 100, 250, 500, 1000];

        return $result;
    }
}
