<?php

namespace Fram;

class PasswordField extends Field
{
    protected $maxLength;
    protected $minlength;

    /**
     * construction du champs
     *
     * @return string
     */
    public function buildWidget(): string
    {
        $widget = '';
        if (!empty($this->errorMessage)) {
            $widget .= '<div class="form-error">' . $this->errorMessage . '</div>';
        }
        $widget .= '<label>' . $this->label . ' <br />(' . $this->minlength . ' caractères minimum )</label><input type="password" class="form-control" name="' . $this->name . '"';
        if (!empty($this->minLength)) {
            $widget .= ' minLength="' . $this->minLength . '"';
        }
        if (!empty($this->maxLength)) {
            $widget .= ' maxlength="' . $this->maxLength . '"';
        }
        return $widget .= ' />';
    }

    // SETTER //

    /**
     * Renseigne la longueur minimum
     *
     * @param int $minlength
     * @return void
     */
    public function setMinLength(int $minlength)
    {
        if ($minlength > 0) {
            $this->minlength = $minlength;
        } else {
            throw new \RuntimeException('La longueur minimale doit être un nombre supérieur à 0');
        }
    }

    /**
     * Renseigne la longueur maximum
     *
     * @param int $maxLength
     * @return void
     */
    public function setMaxLength(int $maxLength)
    {
        if ($maxLength > 0) {
            $this->maxLength = $maxLength;
        } else {
            throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
        }
    }
}
