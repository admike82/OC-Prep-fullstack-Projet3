<?php

namespace App\Frontend\Modules\Users;

use Entity\Account;
use Fram\Application;
use Fram\FormHandler;
use Fram\HTTPRequest;
use Fram\BackController;
use FormBuilder\AccountFormBuilder;
use Model\AccountsManagerPDO;

class UsersController extends BackController
{

    /** @var AccountsManagerPDO $accountsManager */
    protected $accountsManager;

    public function __construct(Application $app, string $module, string $action)
    {
        parent::__construct($app, $module, $action);
        $this->accountsManager = $this->managers->getManagerOf('Accounts');
    }

    /**
     * Génération de la page modification de l'utilisateur
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeUpdateUser(HTTPRequest $request)
    {
        /** @var Account $user */
        $user = $this->app->user()->getAttribute('account');

        if ($request->method() == 'POST') {
            $account = new Account([
                'idUser' => $user->idUser(),
                'nom' => $request->postData('nom'),
                'prenom' => $request->postData('prenom'),
                'username' => $request->postData('username'),
                'password' => $request->postData('password'),
                'question' => $request->postData('question'),
                'reponse' => $request->postData('reponse'),
            ]);
            $getAccount = $this->accountsManager->getByUsername($request->postData('username'));
            if ($request->postData('username') != $user->username() && !empty($getAccount)) {
                $account->setUsername('');
                $this->app->user()->setFlash([
                    'class' => 'info',
                    'message' => 'le nom d\'utilisateur ' . $request->postData('username') . ' est déjà utilisé'
                ]);
            }
        } else {
            $account = clone $user;
        }

        $formBuilder = new AccountFormBuilder($account);
        $formBuilder->build();
        $form = $formBuilder->form();

        if ($request->method() == 'POST' && $form->isValid()) {
            $password = $request->postData('password');
            if (password_verify($password, $this->app->user()->getAttribute('account')->password())) {
                $hashed_password = password_hash($request->postData('password'), PASSWORD_DEFAULT);
                $account->setPassword($hashed_password);
                $formHandler = new FormHandler($form, $this->accountsManager, $request);
                if ($formHandler->process()) {
                    $this->app->user()->setFlash([
                        'class' => 'success',
                        'message' => 'Le compte utilisateur a été modifié'
                    ]);
                    $this->app->user()->delAttribute('account');
                    $this->app->user()->setAttribute('account', $account);
                    $this->app->httpResponse()->redirect('/');
                }
            } else {
                $account->setPassword('');
                $this->app->user()->setFlash([
                    'class' => 'danger',
                    'message' => 'Mot de passe érroné !'
                ]);
            }
        }
        $this->page->addVar('form', $form->createView())
            ->addVar('title', 'Profil');
    }

    /**
     * Génération de la page modifier le mot de passe
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeModifyPassword(HTTPRequest $request)
    {
        /** @var Account $user */
        $user = $this->app->user()->getAttribute('account');
        if ($request->method() == 'POST') {
            $newPassword = $request->postData('newPassword');
            $confirmPassword = $request->postData('confirmPassword');
            if ($newPassword == $confirmPassword) {
                if (strlen($newPassword) < 8) {
                    $this->app->user()->setFlash([
                        'class' => 'danger',
                        'message' => 'Le nouveau mot de passe doit faire minimum 8 caractère !'
                    ]);
                } else {
                    $account = clone $user;
                    if (password_verify($request->postData('oldPassword'), $account->password())) {
                        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                        $account->setPassword($newPasswordHash);
                        $this->accountsManager->save($account);
                        $this->app->user()->setFlash([
                            'class' => 'success',
                            'message' => 'Le mot de passe a bien été changé !'
                        ]);
                        $this->app->user()->delAttribute('account');
                        $this->app->user()->setAttribute('account', $account);
                        $this->app->httpResponse()->redirect('/update-user.html');
                    } else {
                        $this->app->user()->setFlash([
                            'class' => 'danger',
                            'message' => 'Mot de passe érroné !'
                        ]);
                    }
                }
            } else {
                $this->app->user()->setFlash([
                    'class' => 'danger',
                    'message' => 'La confimation et le nouveau mot de passe différent !'
                ]);
            }
        }
        $this->page->addVar('title', 'Changer de mot de passe');
    }

    /**
     * Génération de la page de suppression du compte
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeDeleteUser(HTTPRequest $request)
    {
        if ($request->method() == 'POST') {
            $user = $this->app->user()->getAttribute('account');
            if (password_verify($request->postData('password'), $user->password())) {
                $this->accountsManager->delete($user->idUser());
                $this->app->user()->setFlash([
                    'class' => 'info',
                    'message' => 'Le compte a bien été supprimmer !'
                ]);
                $this->app->httpResponse()->redirect('/logOut.html');
            } else {
                $this->app->user()->setFlash([
                    'class' => 'danger',
                    'message' => 'Mot de passe érroné !'
                ]);
            }
        }
        $this->page->addVar('title', 'Suppression du compte');
    }
}
