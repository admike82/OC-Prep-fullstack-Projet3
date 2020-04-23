<?php

namespace App\Log\Modules\Connexion;

use Entity\Account;
use Fram\Questions;
use Fram\Application;
use Fram\FormHandler;
use Fram\HTTPRequest;
use Fram\SelectField;
use Fram\StringField;
use Fram\PasswordField;
use Fram\BackController;
use Model\AccountsManagerPDO;
use FormBuilder\AccountFormBuilder;

class ConnexionController extends BackController
{
    /** @var AccountsManagerPDO $accountsManager */
    protected $accountsManager;

    public function __construct(Application $app, string $module, string $action)
    {
        parent::__construct($app, $module, $action);
        $this->accountsManager = $this->managers->getManagerOf('Accounts');
    }

    /**
     * Génération de la page connection
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeIndex(HTTPRequest $request)
    {
        if ($request->postExists('username')) {
            $username = $request->postData('username');
            $password = $request->postData('password');

            // On récupère les données de l'utilisateur
            $account = $this->accountsManager->getByUsername($username);

            if (empty($account)) {
                $this->app->user()->setFlash([
                    'class' => 'danger',
                    'message' => 'Le nom d\'utilisateur est incorrect.'
                ]);
            } else if (password_verify($password, $account->password())) {
                $this->app->user()->setAuthenticated(true);
                $this->app->user()->setAttribute('account', $account);
                $this->app->httpResponse()->redirect('/');
            } else {
                $this->app->user()->setFlash([
                    'class' => 'danger',
                    'message' => 'Le mot de passe est incorrect.'
                ]);
            }
        }
        $this->page->addVar('title', 'Connexion');
    }

    /**
     * Génération de la page Mot de passe oublié
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeForget(HTTPRequest $request)
    {
        if ($request->postExists('username')) {
            $username = $request->postData('username');
            $question = $request->postData('question');
            $reponse = $request->postData('reponse');
            // On récupère les données de l'utilisateur
            $account = $this->accountsManager->getByUsername($username);
            if (empty($account)) {
                $this->app->user()->setFlash([
                    'class' => 'danger',
                    'message' => 'Le nom d\'utilisateur est incorrect.'
                ]);
                unset($username);
            } else if ($question == $account->question() && $reponse == $account->reponse()) {
                $this->app->user()->setAuthenticated(false);
                $this->app->user()->setAttribute('account', $account);
                $this->app->httpResponse()->redirect('./newPassword.html');
            } else {
                $this->app->user()->setFlash([
                    'class' => 'danger',
                    'message' => 'La question secrète ou la réponse est incorrect.'
                ]);
                unset($question);
                unset($reponse);
            }
        }
        $questions = new Questions;
        $form = '';
        $fields = [];
        $fields[] = new StringField([
            'label' => 'Nom d\'utilisateur',
            'name' => 'username',
            'value' => isset($username) ? $username : ''
        ]);
        $fields[] = new SelectField([
            'label' => 'Question secrète',
            'name' => 'question',
            'selected' => isset($question) ? $question : '',
            'selectOptions' => $questions->questions()
        ]);
        $fields[] = new StringField([
            'label' => 'Réponse',
            'name' => 'reponse',
            'value' => isset($reponse) ? $reponse : ''
        ]);
        foreach ($fields as $field) {
            $form .= $field->buildWidget() . '<br />';
        }
        $this->page->addVar('form', $form)
            ->addVar('title', 'Mot de passe oublié');
    }

    /**
     * Génération de la page Nouveau mot de passe
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeNewPassword(HTTPRequest $request)
    {
        /** @var Account $account */
        $account = $this->app->user()->getAttribute('account');
        if (!isset($account)) {
            $this->app->httpResponse()->redirect('.');
        }
        if ($request->postExists('password')) {
            $password = $request->postData('password');
            if (strlen($password) < 8) {
                $this->app->user()->setFlash([
                    'class' => 'danger',
                    'message' => 'le mot de passe spécifié est trop court (8 caractères minimum)'
                ]);
            } else if (strlen($password) > 20) {
                $this->app->user()->setFlash([
                    'class' => 'danger',
                    'message' => 'le mot de passe spécifié est trop long (20 caractères maximum)'
                ]);
            } else {
                // On récupère les données de l'utilisateur
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $account->setPassword($hashed_password);
                $this->accountsManager->save($account);
                $this->app->user()->setFlash([
                    'class' => 'success',
                    'message' => 'le mot de passe a bien été changé'
                ]);
                $this->app->httpResponse()->redirect('/');
            }
        }
        $form = '';
        $fields = [];
        $fields[] = new PasswordField([
            'label' => 'Sasissez votre nouveau mot de passe',
            'name' => 'password',
            'minLength' => 8,
        ]);
        foreach ($fields as $field) {
            $form .= $field->buildWidget() . '<br />';
        }

        $this->page->addVar('form', $form)
            ->addVar('title', 'Nouveau mot de passe');
    }

    /**
     * Génération de la page créer un compte
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeRegister(HTTPRequest $request)
    {
        if ($request->method() == 'POST') {
            $account = new Account([
                'nom' => $request->postData('nom'),
                'prenom' => $request->postData('prenom'),
                'username' => $request->postData('username'),
                'password' => $request->postData('password'),
                'question' => $request->postData('question') !== NULL ? $request->postData('question') : "",
                'reponse' => $request->postData('reponse'),
            ]);
            $getAccount = $this->accountsManager->getByUsername($request->postData('username'));

            if (!empty($getAccount)) {
                $account->setUsername('');
                $this->app->user()->setFlash([
                    'class' => 'info',
                    'message' => 'Ce nom d\'utilisateur est déjà utilisé'
                ]);
            }
        } else {
            $account = new Account;
        }

        $formBuilder = new AccountFormBuilder($account);
        $formBuilder->build();
        $form = $formBuilder->form();

        if ($request->method() == 'POST' && $form->isValid()) {
            $hashed_password = password_hash($request->postData('password'), PASSWORD_DEFAULT);
            $account->setPassword($hashed_password);
            $formHandler = new FormHandler($form, $this->accountsManager, $request);
            if ($formHandler->process()) {
                $this->app->user()->setFlash([
                    'class' => 'success',
                    'message' => 'Le compte utilisateur est créé'
                ]);

                $this->app->httpResponse()->redirect('/');
            }
        }
        $this->page->addVar('form', $form->createView())
            ->addVar('title', 'Créer un compte');
    }
}
