<?php

namespace Fram;

class StringField extends Field
{
    protected $maxLength;

    /**
     * Construction du champs
     *
     * @return string
     */
    public function buildWidget(): string
    {
        $widget = '';
        if (!empty($this->errorMessage)) {
            $widget .= '<div class="form-error">' . $this->errorMessage . '</div>';
        }
        $widget .= '<label>' . $this->label . '</label><input type="text" class="form-control" name="' . $this->name . '"';
        if (!empty($this->value)) {
            $widget .= ' value="' . htmlspecialchars($this->value) . '"';
        }
        if (!empty($this->maxLength)) {
            $widget .= ' maxlength="' . $this->maxLength . '"';
        }
        return $widget .= ' />';
    }

    // SETTER //
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
