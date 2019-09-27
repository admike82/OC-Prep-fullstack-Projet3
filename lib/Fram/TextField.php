<?php
namespace Fram;

class TextField extends Field
{
    protected $cols;
    protected $rows;

    /**
     * Constrcution du champs
     *
     * @return string
     */
    public function buildWidget() :string {
        $widget = '';
        if (!empty($this->errorMessage)) {
            $widget .= '<div class="form-error">' . $this->errorMessage . '</div>';
        }
        $widget .= '<label>' . $this->label . '</label><textarea class="form-control" name="' . $this->name . '"';
        if (!empty($this->cols)) {
            $widget .= ' cols="' . $this->cols . '"';
        }
        if (!empty($this->rows)) {
            $widget .= ' rows="' . $this->rows . '"';
        }
        $widget .= '>';
        if (!empty($this->value)) {
            $widget .= htmlspecialchars($this->value);
        }
        return $widget . '</textarea>';
    }

    // SETTERS //

    public function setCols(int $cols) {
        if ($cols > 0) {
            $this->cols = $cols;
        }
    }

    public function setRows(int $rows) {
        if ($rows > 0) {
            $this->rows = $rows;
        }
    }
}