<?php
namespace Fram;

class NotNullValidator extends Validator
{
  public function isValid($value) :bool {
    return $value != '';
  }
}