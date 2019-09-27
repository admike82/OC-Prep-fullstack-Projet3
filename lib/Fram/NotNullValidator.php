<?php
namespace Fram;

class NotNullValidator extends Validator
{
  /**
   * Vérification de la validité du champs
   *
   * @param mixed $value
   * @return boolean
   */
  public function isValid($value) :bool {
    return $value != '';
  }
}