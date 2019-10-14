<?php

namespace App\Frontend\Modules\Acteurs;

use Entity\Post;
use Entity\Vote;
use Fram\FormHandler;
use Fram\HTTPRequest;
use Fram\BackController;
use FormBuilder\PostFormBuilder;

class ActeursController extends BackController {
    
    /**
     * Generation de la page d'accueil, utilisteur connecté
     *
     * @return void
     */
    public function executeIndex()
    {
        $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
        $this->page->addVar('title', 'Listes des acteurs');
        $manager = $this->managers->getManagerOf('Acteurs');
        $listeActeurs = $manager->getList();
        foreach ($listeActeurs as $acteur) {
            if (strlen($acteur->description()) > $nombreCaracteres) {
                $debut = substr($acteur->description(), 0, $nombreCaracteres);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

                $acteur->setDescription($debut);
            }
        }
        $this->page->addVar('listeActeurs', $listeActeurs);
    }

    /**
     * génération de la page détail de l'acteur
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeShow(HTTPRequest $request)
    {
        $acteur = $this->managers->getManagerOf('Acteurs')->getUnique($request->getData('id'));
        if (empty($acteur)){
            $this->app->httpResponse()->redirect404();
        }
        $managerVotes = $this->managers->getManagerOf('Votes');

        $nbrLike = $managerVotes->countLike($acteur->idActeur());
        $nbrDislike = $managerVotes->countDislike($acteur->idActeur());
        $Comments = $this->managers->getManagerOf('Posts')->getListOf($acteur->idActeur());
        
        $vote = $managerVotes->get($this->app->user()->getAttribute('account')['idUser'], $acteur->idActeur());
        
        empty($vote)?$like='':$like = $vote->vote();;
        $listPosts = [];
        if (!empty($Comments)) {
            foreach ($Comments as $comment){
                $user = $this->managers->getManagerOf('Accounts')->get($comment['idUser']);
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
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeAddComment(HTTPRequest $request) 
    {
        $acteur = $this->managers->getManagerOf('Acteurs')->getUnique($request->getData('id'));
        $this->page->addVar('title', 'Ajouter un commentaire sur ' . $acteur->acteur());
        // à modifier
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

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Posts'), $request);

        if ($formHandler->process()) {
            $this->app->user()->setFlash([
                'class' => 'success',
                'message' => 'Le commentaire a bien été ajouté'
                ]);

            $this->app->httpResponse()->redirect('/acteur-' . $acteur->idActeur() . '.html');
        }

        $this->page->addVar('acteur', $acteur);
        $this->page->addVar('form', $form->createView());
    }

    /**
     * Génération de la page de modification de commentaire
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeUpdateComment(HTTPRequest $request)
    {
        $post = $this->managers->getManagerOf('Posts')->get($request->getData('id'));
        if (empty($post)){
            $this->app->httpResponse()->redirect404();
        }
        
        $acteur = $this->managers->getManagerOf('Acteurs')->getUnique($post->idActeur());

        if ($post->idUser() != $this->app->user()->getAttribute('account')['idUser']){
            $this->app->user()->setFlash([
                'class' => 'danger',
                'message' => 'Vous pouvez modifier uniquement vos commentaires !'
            ]);
            $this->app->httpResponse()->redirect('/acteur-' . $acteur->idActeur() . '.html');
        }
        
        $this->page->addVar('title', 'Modifier un commentaire sur ' . $acteur->acteur());
        
        if ($request->method() == 'POST') {
            $post->setPost($request->postData('post'));
        }

        $formBuilder = new PostFormBuilder($post);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Posts'), $request);

        if ($request->method() == 'POST' && $formHandler->process()) {
            $this->app->user()->setFlash([
                'class' => 'success',
                'message' => 'Le commentaire a bien été modifié'
            ]);

            $this->app->httpResponse()->redirect('/acteur-' . $acteur->idActeur() . '.html');
        }

        $this->page->addVar('acteur', $acteur);
        $this->page->addVar('form', $form->createView());
    }

    /**
     * Suppression d'un commentaire
     *
     * @param HTTPRequest $request
     * @return void
     */
    public function executeDeleteComment(HTTPRequest $request) 
    {
        $manager = $this->managers->getManagerOf('Posts');
        $post = $manager->get($request->getData('id'));
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

        $acteur = $this->managers->getManagerOf('Acteurs')->getUnique($post->idActeur());
        $manager->delete($post->idPost());
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
        $manager = $this->managers->getManagerOf('Votes');
        $vote = new Vote([
            'idUser' => $this->app->user()->getAttribute('account')['idUser'],
            'idActeur' => $request->getData('id'),
            'vote' => true,
        ]);
        $manager->save($vote);
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
        $manager = $this->managers->getManagerOf('Votes');
        $vote = new Vote([
            'idUser' => $this->app->user()->getAttribute('account')['idUser'],
            'idActeur' => $request->getData('id'),
            'vote' => false,
        ]);
        $manager->save($vote);
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
        $this->managers->getManagerOf('Votes')->delete($this->app->user()->getAttribute('account')['idUser'], $request->getData('id'));
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