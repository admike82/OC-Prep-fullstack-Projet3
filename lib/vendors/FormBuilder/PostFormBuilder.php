<?php

namespace FormBuilder;

use Fram\FormBuilder;
use Fram\TextField;
use Fram\NotNullValidator;

/**
 * Classe permettant créer le formulaire des commentaires
 * @author Michaël GROSS <admike@admike.fr>
 */
class PostFormBuilder extends FormBuilder
{

    /**
     * Construction du formulaire
     *
     * @return void
     */
    public function build()
    {
        $this->form->add(new TextField([
            'label' => 'Votre commentaire',
            'name' => 'post',
            'rows' => 7,
            'cols' => 50,
            'validators' => [
                new NotNullValidator('Veuillez saisir un commentaire'),
            ],
        ]));
    }
}
