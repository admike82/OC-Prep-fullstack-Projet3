<?php
namespace FormBuilder;

use Fram\FormBuilder;
use Fram\PasswordField;
use Fram\NotNullValidator;
use Fram\MaxLengthValidator;
use Fram\MinLengthValidator;

class NewPasswordFormBuilder extends FormBuilder {
    public function build() {
        $this->form->add(new PasswordField([
            'label' => 'Mot de passe',
            'name' => 'password',
            'minLength' => 8,
            'maxLength' => 20,
            'validators' => [
                new MinLengthValidator('le mot de passe spécifié est trop court (8 caractères minimum)', 8),
                new MaxLengthValidator('le mot de passe spécifié est trop long (20 caractères maximum)', 20),
                new NotNullValidator('Merci de renseigner votre prénom'),
            ],
        ]));
    }
}