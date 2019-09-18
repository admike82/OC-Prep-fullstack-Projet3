<?php

namespace App\Info\Modules\Informations;

use Fram\TextField;
use Fram\HTTPRequest;
use Fram\StringField;
use Fram\BackController;
use Fram\MailValidator;
use Fram\NotNullValidator;
use Fram\MaxLengthValidator;

class InformationsController extends BackController
{
    public function executeindex()
    {
        $this->page->addVar('title', 'Mentions légales');
    }

    public function executeContact(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Contact');
        $nom = '';
        $prenom = '';
        $mail = '';
        $message = '';
        if ($this->app->user()->getAttribute('account')) {
            $nom = $this->app->user()->getAttribute('account')['nom'];
            $prenom = $this->app->user()->getAttribute('account')['prenom'];
        }

        if ($request->method() == 'POST') {
            $nom = $request->postData('nom');
            $prenom = $request->postData('prenom');
            $mail = $request->postData('mail');
            $message = $request->postData('message');
        }

        $form = '';
        $fields = [];
        $fields[] = new StringField([
            'label' => 'Nom',
            'name' => 'nom',
            'value' => $nom,
            'maxLength' => 20,
            'validators' => [
                new MaxLengthValidator('le nom spécifié est trop long (20 caractères maximum)', 20),
                new NotNullValidator('Merci de renseigner votre nom'),
            ],
        ]);
        $fields[] = new StringField([
            'label' => 'Prénom',
            'name' => 'prenom',
            'value' => $prenom,
            'validators' => [
                new MaxLengthValidator('le prénom spécifié est trop long (20 caractères maximum)', 20),
                new NotNullValidator('Merci de renseigner votre prénom'),
            ],
        ]);
        $fields[] = new StringField([
            'label' => 'Adresse e-mail',
            'name' => 'mail',
            'value' => $mail,
            'validators' => [
                new MailValidator('l\'adresse mail saisi n\'est pas valide'),
                new NotNullValidator('Merci de renseigner votre mail'),
            ],
        ]);
        $fields[] = new TextField([
            'label' => 'Message',
            'name' => 'message',
            'value' => $message,
            'validators' => [
                new NotNullValidator('Merci de sasir votre message'),
            ],
        ]);

        if ($request->method() == 'POST') {
            $valid = true;
            foreach ($fields as $field) {
                if (!$field->isValid()) {
                    $valid = false;
                }
            }
            if ($valid) {
                $to      = $this->app->config()->get('mail');
                $subject = 'Messsage envoyé de GBAF';
                $message = 'Message de : ' . $prenom . ' ' . $nom . '. \r\n' . 'message : ' .$message;
                $headers = array(
                    'From' => $mail,
                    'Reply-To' => $mail,
                    'X-Mailer' => 'PHP/' . phpversion()
                );

                if (mail($to, $subject, $message, $headers)) {
                    $this->app->user()->setFlash([
                        'class' => 'success',
                        'message' => 'Le message a bien été envoyé'
                    ]);
                } else {
                    $this->app->user()->setFlash([
                        'class' => 'danger',
                        'message' => 'Une erreur s\'est produite au moment de l\'envoi du message'
                    ]);
                }
            }
        }

        foreach ($fields as $field) {
            $form .= $field->buildWidget() . '<br />';
        }

        $this->page->addVar('form', $form);
    }
}
