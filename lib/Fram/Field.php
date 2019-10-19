<?php

namespace Fram;

abstract class Field
{
    use Hydrator;

    protected $errorMessage;
    protected $label;
    protected $name;
    protected $validators = [];
    protected $value;

    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->hydrate($options);
        }
    }

    /**
     * Génération des champs de formulaire
     *
     * @return string
     */
    abstract public function buildWidget();

    /**
     * Vérification de la vaiidité du champs
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($this->value)) {
                $this->errorMessage = $validator->errorMessage();
                return false;
            }
        }

        return true;
    }

    // GETTERS //

    /**
     * retourne le label du champs
     *
     * @return string
     */
    public function label(): string
    {
        return $this->label;
    }

    /**
     * retourne le longueur du champs
     *
     * @return int
     */
    public function length(): int
    {
        return $this->length;
    }

    /**
     * retourne le nom du champs
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * retourne les validateurs
     *
     * @return array
     */
    public function validators(): array
    {
        return $this->validators;
    }

    /**
     * retourne la valeur
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    // SETTERS //

    /**
     * Renseigne le label du champs
     *
     * @param string $label
     * @return void
     */
    public function setLabel(string $label)
    {
        if (is_string($label)) {
            $this->label = $label;
        }
    }

    /**
     * Renseigne la longueur du champs
     *
     * @param int $length
     * @return void
     */
    public function setLength(int $length)
    {
        if ($length > 0) {
            $this->length = $length;
        }
    }

    /**
     * Renseigne le nom du champs
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name)
    {
        if (is_string($name)) {
            $this->name = $name;
        }
    }

    /**
     * renseigne les validateurs
     *
     * @param array $validators
     * @return void
     */
    public function setValidators(array $validators)
    {
        foreach ($validators as $validator) {
            if ($validator instanceof Validator && !in_array($validator, $this->validators)) {
                $this->validators[] = $validator;
            }
        }
    }

    /**
     * Renseigne la valeur
     *
     * @param string $value
     * @return void
     */
    public function setValue(string $value)
    {
        if (is_string($value)) {
            $this->value = $value;
        }
    }
}
