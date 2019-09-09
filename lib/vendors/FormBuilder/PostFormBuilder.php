<?php
namespace FormBuilder;

use Fram\FormBuilder;
use Fram\TextField;
use Fram\NotNullValidator;

class PostFormBuilder extends FormBuilder {
    public function build() {
        $this->form->add(new TextField([
                'label' => 'Commentaire',
                'name' => 'post',
                'rows' => 7,
                'cols' => 50,
                'validators' => [
                    new NotNullValidator('Veuillez saisir un commentaire'),
                ],
            ]));
    }
}