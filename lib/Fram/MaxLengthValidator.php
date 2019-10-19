<?php

namespace Fram;

class MaxLengthValidator extends Validator
{
  protected $maxLength;

  public function __construct(string $errorMessage, int $maxLength)
  {
    parent::__construct($errorMessage);

    $this->setMaxLength($maxLength);
  }

  /**
   * Vérification de la validité du champs
   *
   * @param mixed $value
   * @return boolean
   */
  public function isValid($value): bool
  {
    return strlen($value) <= $this->maxLength;
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
