<?php
namespace Fram;

class MinLengthValidator extends Validator
{
    protected $minLength;

    public function __construct(string $errorMessage, int $minLength)
    {
        parent::__construct($errorMessage);

        $this->setMinLength($minLength);
    }

    public function isValid($value): bool
    {
        return strlen($value) >= $this->minLength;
    }

    public function setMinLength(int $minLength)
    {
        if ($minLength > 0) {
            $this->minLength = $minLength;
        } else {
            throw new \RuntimeException('La longueur minimale doit être un nombre supérieur à 0');
        }
    }
}