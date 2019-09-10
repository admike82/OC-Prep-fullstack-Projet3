<?php

namespace App\Backend\Modules\Connexion;

use Entity\Account;
use Fram\Questions;
use Fram\FormHandler;
use Fram\HTTPRequest;
use Fram\BackController;
use FormBuilder\AccountFormBuilder;

class ConnexionController extends BackController
{

    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Connexion');
        if ($request->postExists('username')) {
            $username = $request->postData('username');
            $password = $request->postData('password');

            // On récupère les données de l'utilisateur
            $account = $this->managers->getManagerOf('Accounts')->getByUsername($username);

            if (empty($account)) {
                $this->app->user()->setFlash('Le nom d\'utilisateur est incorrect.');
            } else if (password_verify($password, $account->password())) {
                $this->app->user()->setAuthenticated(true);
                $this->app->user()->setAttribute('account', $account);
                $this->app->httpResponse()->redirect('/');
            } else {
                $this->app->user()->setFlash('Le mot de passe est incorrect.');
            }
        }
    }

    public function executeForget(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Question secrète');
        if ($request->postExists('username')) {
            $username = $request->postData('username');
            $question = $request->postData('question');
            $reponse = $request->postData('reponse');

            // On récupère les données de l'utilisateur
            $account = $this->managers->getManagerOf('Accounts')->getByUsername($username);

            if (empty($account)) {
                $this->app->user()->setFlash('Le nom d\'utilisateur est incorrect.');
            } else if ($question == $account->question() && $reponse == $account->reponse()) {
                $this->app->user()->setAuthenticated(false);
                $this->app->user()->setAttribute('account', $account);
                $this->app->httpResponse()->redirect('./newPassword.html');
            } else {
                $this->app->user()->setFlash('La question secrète ou la réponse est incorrect.');
            }
        }
        $selectOptions = Questions::questions();
        $this->page->addVar('selectOptions', $selectOptions);
    }

    public function executeNewPassword(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Nouveau mot de passe');
        $account = $this->app->user()->getAttribute('account');
        if (!isset($account)) {
            $this->app->httpResponse()->redirect('.');
        }
        if ($request->postExists('password')) {
            $password = $request->postData('password');
            if (strlen($password) < 8) {
                $this->app->user()->setFlash('le mot de passe spécifié est trop court (8 caractères minimum)');
            } else if (strlen($password) > 8) {
                $this->app->user()->setFlash('le mot de passe spécifié est trop long (20 caractères maximum)');
            } else {
                // On récupère les données de l'utilisateur
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $account->setPassword($hashed_password);
                $this->managers->getManagerOf('Accounts')->save($account);
                $this->app->user()->setFlash('le mot de passe a bien été changé');
                $this->app->httpResponse()->redirect('/');
            }
        }
    }

    public function executeRegister(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Inscription');

        if ($request->method() == 'POST') {
            $account = $this->managers->getManagerOf('Accounts')->getByUsername($request->postData('username'));

            if (empty($account)) {
                $hashed_password = password_hash($request->postData('password'), PASSWORD_DEFAULT);
                $account = new Account([
                    'nom' => $request->postData('nom'),
                    'prenom' => $request->postData('prenom'),
                    'username' => $request->postData('username'),
                    'password' => $hashed_password,
                    'question' => $request->postData('question'),
                    'reponse' => $request->postData('reponse'),
                ]);
            } else {
                $account = new Account;
                $this->app->user()->setFlash('Ce nom d\'utilisateur est déjà utilisé');
            }
        } else {
            $account = new Account;
        }

        $formBuilder = new AccountFormBuilder($account);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Accounts'), $request);

        if ($formHandler->process()) {
            $this->app->user()->setFlash('Le compte utilisateur est créé');

            $this->app->httpResponse()->redirect('/');
        }

        $this->page->addVar('form', $form->createView());
    }
}
