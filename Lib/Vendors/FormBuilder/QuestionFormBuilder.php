<?php
namespace FormBuilder;

use Fram\Questions;
use Fram\FormBuilder;
use Fram\SelectField;
use Fram\StringField;
use Fram\NotNullValidator;
use Fram\MaxLengthValidator;

class QuestionFormBuilder extends FormBuilder {

    public function build() {
        $this->form->add(new StringField([
            'label' => 'Nom d\'utilisateur',
            'name' => 'username',
            'maxLength' => 20,
            'validators' => [
                new MaxLengthValidator('le nom d\'utilisateur spécifié est trop long (20 caractères maximum)', 20),
                new NotNullValidator('Merci de renseigner votre nom d\'utilisateur'),
            ],
        ]))
        ->add(new SelectField([
            'label' => 'Question secrète',
            'name' => 'question',
            'selectOptions' => Questions::questions(),
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