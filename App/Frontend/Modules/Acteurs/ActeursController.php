<?php

namespace App\Frontend\Modules\Acteurs;

use Entity\Post;
use Entity\Vote;
use Fram\FormHandler;
use Fram\HTTPRequest;
use Fram\BackController;
use FormBuilder\PostFormBuilder;

class ActeursController extends BackController {
    
    public function executeIndex(HTTPRequest $request)
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

    public function executeShow(HTTPRequest $request)
    {
        $acteur = $this->managers->getManagerOf('Acteurs')->getUnique($request->getData('id'));
        if (empty($acteur)){
            $this->app->httpResponse()->redirect404();
        }
        $nbrLike = $this->managers->getManagerOf('Votes')->countLike($acteur->idActeur());
        $Comments = $this->managers->getManagerOf('Posts')->getListOf($acteur->idActeur());
        $vote = $this->managers->getManagerOf('Votes')->get($this->app->user()->getAttribute('account')['idUser'], $acteur->idActeur());
        empty($vote)?$like=false:$like=true;
        $listPosts = [];
        if (!empty($Comments)) {
            foreach ($Comments as $comment){
                $user = $this->managers->getManagerOf('Accounts')->get($comment['idUser']);
                $listPosts[] = ['post' => $comment, 'user' => $user];
            }
        }
        $this->page->addVar('title', $acteur->acteur());
        $this->page->addVar('acteur', $acteur);
        $this->page->addVar('nbrLike', $nbrLike);
        $this->page->addVar('like', $like);
        $this->page->addVar('listPosts', $listPosts);
    }

    public function executeAddComment(HTTPRequest $request) {
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
            $this->app->user()->setFlash('Le commentaire a bien été ajouté');

            $this->app->httpResponse()->redirect('/acteur-' . $acteur->idActeur() . '.html');
        }

        $this->page->addVar('acteur', $acteur);
        $this->page->addVar('form', $form->createView());
    }

    public function executeLike(HTTPRequest $request) {
        $manager = $this->managers->getManagerOf('Votes');
        $vote = new Vote([
            'idUser' => $this->app->user()->getAttribute('account')['idUser'],
            'idActeur' => $request->getData('id'),
            'vote' => true,
        ]);
        $manager->save($vote);
        $this->app->httpResponse()->redirect('/acteur-' . $request->getData('id') . '.html');
    }

    public function executeDislike(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Votes')->delete($this->app->user()->getAttribute('account')['idUser'], $request->getData('id'));
        $this->app->httpResponse()->redirect('/acteur-' . $request->getData('id') . '.html');
    }

    public function executeLogOut()
    {
        $this->app->user()->logOut();
        $this->app->httpResponse()->redirect('/');
    }
}