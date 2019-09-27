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
    public function isValid() :bool
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

    public function label() :string
    {
        return $this->label;
    }

    public function length() :int
    {
        return $this->length;
    }

    public function name() :string
    {
        return $this->name;
    }

    public function validators() :array
    {
        return $this->validators;
    }

    public function value() :string
    {
        return $this->value;
    }

    // SETTERS //
    
    public function setLabel(string $label)
    {
        if (is_string($label)) {
            $this->label = $label;
        }
    }

    public function setLength(int $length)
    {
        if ($length > 0) {
            $this->length = $length;
        }
    }

    public function setName(string $name)
    {
        if (is_string($name)) {
            $this->name = $name;
        }
    }

    public function setValidators(array $validators)
    {
        foreach ($validators as $validator) {
            if ($validator instanceof Validator && !in_array($validator, $this->validators)) {
                $this->validators[] = $validator;
            }
        }
    }

    public function setValue($value)
    {
        if (is_string($value)) {
            $this->value = $value;
        }
    }
}