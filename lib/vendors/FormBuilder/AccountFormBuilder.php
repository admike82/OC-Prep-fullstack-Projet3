<?php

namespace FormBuilder;

use Fram\Questions;
use Fram\FormBuilder;
use Fram\SelectField;
use Fram\StringField;
use Fram\NameValidator;
use Fram\PasswordField;
use Fram\NotNullValidator;
use Fram\MaxLengthValidator;
use Fram\MinLengthValidator;

/**
 * Classe permettant de créer le formulaire
 * gestion et création de compte
 * @author Michaël GROSS <admike@admike.fr>
 */
class AccountFormBuilder extends FormBuilder
{

    /**
     * Construction du formulaire
     *
     * @return void
     */
    public function build()
    {
        $questions = new Questions;
        $this->form->add(new StringField([
            'label' => 'Nom',
            'name' => 'nom',
            'maxLength' => 20,
            'validators' => [
                new NameValidator('Le nom n\'est pas valide'),
                new MaxLengthValidator('le nom spécifié est trop long (20 caractères maximum)', 20),
                new NotNullValidator('Merci de renseigner votre nom'),
            ],
        ]))
            ->add(new StringField([
                'label' => 'Prénom',
                'name' => 'prenom',
                'maxLength' => 20,
                'validators' => [
                    new NameValidator('Le prénom n\'est pas valide'),
                    new MaxLengthValidator('le prénom spécifié est trop long (20 caractères maximum)', 20),
                    new NotNullValidator('Merci de renseigner votre prénom'),
                ],
            ]))
            ->add(new StringField([
                'label' => 'Nom d\'utilisateur',
                'name' => 'username',
                'maxLength' => 20,
                'validators' => [
                    new MaxLengthValidator('le nom d\'utilisateur spécifié est trop long (20 caractères maximum)', 20),
                    new NotNullValidator('Merci de renseigner votre nom d\'utilisateur'),
                ],
            ]))
            ->add(new PasswordField([
                'label' => 'Mot de passe',
                'name' => 'password',
                'minLength' => 8,
                'maxLength' => 20,
                'validators' => [
                    new MinLengthValidator('le mot de passe spécifié est trop court (8 caractères minimum)', 8),
                    new NotNullValidator('Merci de renseigner votre mot de passe'),
                ],
            ]))
            ->add(new SelectField([
                'label' => 'Question secrète',
                'name' => 'question',
                'selectOptions' => $questions->questions(),
                'selected' => $this->form->entity()->question(),
                'validators' => [
                    new NotNullValidator('Merci de selectionner votre question secrète'),
                ],
            ]))
            ->add(new StringField([
                'label' => 'Réponse',
                'name' => 'reponse',
                'maxLength' => 20,
                'validators' => [
                    new MaxLengthValidator('la réponse spécifié est trop long (20 caractères maximum)', 20),
                    new NotNullValidator('Merci de renseigner votre réponse'),
                ],
            ]));
    }
}
