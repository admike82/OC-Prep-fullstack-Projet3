<?php

namespace Fram;

class NameValidator extends Validator
{
    public function isValid($value): bool
    {
        return preg_match('`^(\p{L}+[\'-]?\p{L}+[\s]?){1,30}$`u', $value);
    }
}
