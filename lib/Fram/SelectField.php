<?php

namespace Fram;

class SelectField extends Field {
    protected $selectOptions = [];

    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->errorMessage)) {
            $widget .= $this->errorMessage . '<br />';
        }

        $widget .= '<label>' . $this->label . '</label><select name="' . $this->name . '"">';

        foreach ($this->selectOptions as $selectOption) {
            $widget .= '<option value ="'. $selectOption.'">'. $selectOption.'</option>';
        }

        return $widget .= ' </select>';
    }

    public function setSelectOptions (array $selectOptions) {
        if (count($selectOptions) > 0){
            $this->selectOptions = $selectOptions;
        }
    }
}