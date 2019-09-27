<?php
namespace Fram;

abstract class Validator
{
    protected $errorMessage;

    public function __construct($errorMessage)
    {
        $this->setErrorMessage($errorMessage);
    }

    /**
     * Contrôle de la validité des champs
     *
     * @param [type] $value
     * @return boolean
     */
    abstract public function isValid($value) :bool;

    // SETTER //

    public function setErrorMessage(string $errorMessage)
    {
        if (is_string($errorMessage)) {
            $this->errorMessage = $errorMessage;
        }
    }

    // GETTER //
    
    public function errorMessage() :string
    {
        return $this->errorMessage;
    }
}