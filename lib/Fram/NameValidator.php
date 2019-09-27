<?php

namespace Fram;

class NameValidator extends Validator
{
    /**
     * Vérification de la validité du champs
     *
     * @param mixed $value
     * @return boolean
     */
    public function isValid($value): bool
    {
        return preg_match('`^(\p{L}+[\'-]?\p{L}+[\s]?){1,30}$`u', $value);
    }
}
