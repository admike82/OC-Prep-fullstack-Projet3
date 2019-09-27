<?php

namespace Fram;

class MailValidator extends Validator
{
    /**
     * Vérification de la validité de l'adresse mail
     *
     * @param string $value
     * @return boolean
     */
    public function isValid($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
