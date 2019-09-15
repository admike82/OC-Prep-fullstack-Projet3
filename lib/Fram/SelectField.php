<?php

namespace Fram;

class SelectField extends Field {
    protected $selectOptions = [];
    protected $selected;

    public function buildWidget()
    {
        $widget = '';

        if (!empty($this->errorMessage)) {
            $widget .= '<div class="form-error">'.$this->errorMessage . '</div>';
        }

        $widget .= '<label>' . $this->label . '</label>
        <select class="form-control" name="' . $this->name . '">
        <option value ="" selected disabled >--- Selectionnez une question ---</option>';

        foreach ($this->selectOptions as $selectOption) {
            $widget .= '<option value ="'. $selectOption.'"';
            if ($selectOption == $this->selected){
                $widget .= ' selected ';
            }
            $widget .= '>'. $selectOption.'</option>
            ';
        }

        return $widget .= ' </select>
        ';
    }

    public function setSelectOptions (array $selectOptions) {
        if (count($selectOptions) > 0){
            $this->selectOptions = $selectOptions;
        }
    }

    public function setSelected($selected) {
        $this->selected = $selected;
    }
}