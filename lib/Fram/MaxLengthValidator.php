<?php
namespace Fram;

class MaxLengthValidator extends Validator
{
  protected $maxLength;
  
  public function __construct(string $errorMessage, int $maxLength) {
    parent::__construct($errorMessage);
    
    $this->setMaxLength($maxLength);
  }
  
  public function isValid(int $value) :bool {
    return strlen($value) <= $this->maxLength;
  }
  
  public function setMaxLength(int $maxLength) {
    if ($maxLength > 0)
    {
      $this->maxLength = $maxLength;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }
}