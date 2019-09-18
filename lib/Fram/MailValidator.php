<?php

namespace Fram;

class MailValidator extends Validator
{
    public function isValid($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
