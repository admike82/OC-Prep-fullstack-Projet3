<?php

namespace App\Frontend\Modules\Acteurs;

use Entity\Post;
use Entity\Vote;
use Fram\Application;
use Fram\FormHandler;
use Fram\HTTPRequest;
use Fram\BackController;
use Model\PostsManagerPDO;
use Model\VotesManagerPDO;
use Model\ActeursManagerPDO;
use Model\AccountsManagerPDO;
use FormBuilder\PostFormBuilder;

class ActeursController extends BackController
{
    /** @var AccountsManagerPDO $accountsManager */
    protected $accountsManager;
    /** @var ActeursManagerPDO $acteursManager */
    protected $acteursManager;
    /** @var PostsManagerPDO $postsManager */
    protected $postsManager;
    /** @var VotesManagerPDO $votesManager */
    protected $votesManager;

    public function __construct(Application $app, string $module, string $action)
    {
        parent::__construct($app, $module, $action);
        $this->accountsManager = $this->managers->getManagerOf('Accounts');
        $this->acteursManager = $this->managers->getManagerOf('Acteurs');
        $this->postsManager = $this->managers->getManagerOf('Posts');
        $this->votesManager = $this->managers->getManagerOf('Votes');
    }

    /**
     * Generation de la page d'accueil, utilisteur connecté
     * @return void
     */
    public function executeIndex()
    {
        $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
        $listeActeurs = $this->acteursManager->getList();
        foreach ($listeActeurs as $acteur) {
            if (strlen($acteur->description()) > $nombreCaracteres) {
                $debut = substr($acteur->description(), 0, $nombreCaracteres);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                $acteur->setDescription($debut);
            }
        }
        $this->page->addVar('listeActeurs', $listeActeurs)
            ->addVar('title', 'Listes des acteurs');
    }

    /**
     * génération de la page détail de l'acteur
     * @param HTTPRequest $request
     * @return void
     */
    public function executeShow(HTTPRequest $request)
    {
        $acteur = $this->acteursManager->getUnique($request->getData('id'));
        if (empty($acteur)) {
            $this->app->httpResponse()->redirect404();
        }

        $nbrLike = $this->votesManager->countLike($acteur->idActeur());
        $nbrDislike = $this->votesManager->countDislike($acteur->idActeur());

        $comments = $this->postsManager->getListOf($acteur->idActeur());

        $vote = $this->votesManager->get($this->app->user()->getAttribute('account')['idUser'], $acteur->idActeur());

        empty($vote) ? $like = '' : $like = $vote->vote();;
        $listPosts = [];
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                $user = $this->accountsManager->get($comment->idUser());
                $listPosts[] = ['post' => $comment, 'user' => $user];
            }
        }
        $this->page->addVar('title', $acteur->acteur())
            ->addVar('acteur', $acteur)
            ->addVar('nbrLike', $nbrLike)
            ->addVar('nbrDislike', $nbrDislike)
            ->addVar('like', $like)
            ->addVar('listPosts', $listPosts);
    }

    /**
     * Génération de la page ajout d'un commentaire
     * @param HTTPRequest $request
     * @return void
     */
    public function executeAddComment(HTTPRequest $request)
    {
        $acteur = $this->acteursManager->getUnique($request->getData('id'));

        if ($request->method() == 'POST') {
            $post = new Post([
                'idUser' => $this->app->user()->getAttribute('account')['idUser'],
                'idActeur' => $acteur->idActeur(),
                'post' => $request->postData('post'),
            ]);
        } else {
            $post = new Post;
        }

        $formBuilder = new PostFormBuilder($post);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->postsManager, $request);

        if ($formHandler->process()) {
            $this->app->user()->setFlash([
                'class' => 'success',
                'message' => 'Le commentaire a bien été ajouté'
            ]);

            $this->app->httpResponse()->redirect('/acteur-' . $acteur->idActeur() . '.html');
        }

        $this->page->addVar('acteur', $acteur)
            ->addVar('form', $form->createView())
            ->addVar('title', 'Ajouter un commentaire sur ' . $acteur->acteur());
    }

    /**
     * Génération de la page de modification de commentaire
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeUpdateComment(HTTPRequest $request)
    {
        $post = $this->postsManager->get($request->getData('id'));
        if (empty($post)) {
            $this->app->httpResponse()->redirect404();
        }

        $acteur = $this->acteursManager->getUnique($post->idActeur());

        if ($post->idUser() != $this->app->user()->getAttribute('account')['idUser']) {
            $this->app->user()->setFlash([
                'class' => 'danger',
                'message' => 'Vous pouvez modifier uniquement vos commentaires !'
            ]);
            $this->app->httpResponse()->redirect('/acteur-' . $acteur->idActeur() . '.html');
        }

        if ($request->method() == 'POST') {
            $post->setPost($request->postData('post'));
        }

        $formBuilder = new PostFormBuilder($post);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->postsManager, $request);

        if ($request->method() == 'POST' && $formHandler->process()) {
            $this->app->user()->setFlash([
                'class' => 'success',
                'message' => 'Le commentaire a bien été modifié'
            ]);

            $this->app->httpResponse()->redirect('/acteur-' . $acteur->idActeur() . '.html');
        }

        $this->page->addVar('acteur', $acteur)
            ->addVar('form', $form->createView())
            ->addVar('title', 'Modifier un commentaire sur ' . $acteur->acteur());
    }

    /**
     * Suppression d'un commentaire
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeDeleteComment(HTTPRequest $request)
    {
        $post = $this->postsManager->get($request->getData('id'));
        if (empty($post)) {
            $this->app->httpResponse()->redirect404();
        }

        if ($post->idUser() != $this->app->user()->getAttribute('account')['idUser']) {
            $this->app->user()->setFlash([
                'class' => 'danger',
                'message' => 'Vous pouvez supprimer uniquement vos commentaires !'
            ]);
            $this->app->httpResponse()->redirect('/acteur-' . $post->idActeur() . '.html');
        }

        $acteur = $this->acteursManager->getUnique($post->idActeur());
        $this->postsManager->delete($post->idPost());
        $this->app->user()->setFlash([
            'class' => 'success',
            'message' => 'Le commentaire a bien été supprimé !'
        ]);
        $this->app->httpResponse()->redirect('/acteur-' . $acteur->idActeur() . '.html');
    }

    /**
     * Ajout d'un like
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeLike(HTTPRequest $request)
    {
        $vote = new Vote([
            'idUser' => $this->app->user()->getAttribute('account')['idUser'],
            'idActeur' => $request->getData('id'),
            'vote' => true,
        ]);
        $this->votesManager->save($vote);
        $this->app->httpResponse()->redirect('/acteur-' . $request->getData('id') . '.html');
    }

    /**
     * Ajout d'un dislike
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeDislike(HTTPRequest $request)
    {
        $vote = new Vote([
            'idUser' => $this->app->user()->getAttribute('account')['idUser'],
            'idActeur' => $request->getData('id'),
            'vote' => false,
        ]);
        $this->votesManager->save($vote);
        $this->app->httpResponse()->redirect('/acteur-' . $request->getData('id') . '.html');
    }

    /**
     * Suppression d'un vote
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeDelLike(HTTPRequest $request)
    {
        $this->votesManager->delete($this->app->user()->getAttribute('account')['idUser'], $request->getData('id'));
        $this->app->httpResponse()->redirect('/acteur-' . $request->getData('id') . '.html');
    }

    /**
     * Déconnectiokn
     *
     * @return void
     */
    public function executeLogOut()
    {
        $this->app->user()->logOut();
        $this->app->httpResponse()->redirect('/');
    }
}
