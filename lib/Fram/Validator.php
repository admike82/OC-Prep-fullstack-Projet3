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
     * @param mixed $value
     * @return boolean
     */
    abstract public function isValid($value): bool;

    // SETTER //

    /**
     * Renseigne le message d'erreur
     * @param string $errorMessage
     * @return void
     */
    public function setErrorMessage(string $errorMessage)
    {
        if (is_string($errorMessage)) {
            $this->errorMessage = $errorMessage;
        }
    }

    // GETTER //

    /**
     * retroune le message d'erreur
     * @return string
     */
    public function errorMessage(): string
    {
        return $this->errorMessage;
    }
}
