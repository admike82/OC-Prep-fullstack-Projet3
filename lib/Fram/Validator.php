<?php
namespace Fram;

abstract class Validator
{
    protected $errorMessage;

    public function __construct($errorMessage)
    {
        $this->setErrorMessage($errorMessage);
    }

    abstract public function isValid($value) :bool;

    public function setErrorMessage(string $errorMessage)
    {
        if (is_string($errorMessage)) {
            $this->errorMessage = $errorMessage;
        }
    }

    public function errorMessage() :string
    {
        return $this->errorMessage;
    }
}