<?php
namespace Fram;

class PasswordField extends Field {
    protected $maxLength;
    protected $minlength;

    public function buildWidget() :string {
        $widget = '';
        if (!empty($this->errorMessage)) {
            $widget .= $this->errorMessage . '<br />';
        }
        $widget .= '<label>' . $this->label . ' ('.$this->minlength.' caractères minimum )</label><input type="password" name="' . $this->name . '"';
        if (!empty($this->minLength)) {
            $widget .= ' minLength="' . $this->minLength . '"';
        }
        if (!empty($this->maxLength)) {
            $widget .= ' maxlength="' . $this->maxLength . '"';
        }
        return $widget .= ' />';
    }

    public function setMinLength(int $minlength)
    {
        if ($minlength > 0) {
            $this->minlength = $minlength;
        } else {
            throw new \RuntimeException('La longueur minimale doit être un nombre supérieur à 0');
        }
    }

    public function setMaxLength(int $maxLength) {
        if ($maxLength > 0) {
            $this->maxLength = $maxLength;
        } else {
            throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
        }
    }
}