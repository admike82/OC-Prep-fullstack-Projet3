<?php

namespace App\Frontend\Modules\Acteurs;

use Fram\HTTPRequest;
use Fram\BackController;

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
        $Comments = $this->managers->getManagerOf('Posts')->getListOf($acteur->idActeur());
        $listPosts = [];
        if (!empty($Comments)) {
            foreach ($Comments as $comment){
                $user = $this->managers->getManagerOf('Accounts')->get($comment['idUser']);
                $listPosts[] = ['post' => $comment, 'user' => $user];
            }
        }
        $this->page->addVar('title', $acteur->acteur());
        $this->page->addVar('acteur', $acteur);
        $this->page->addVar('listPosts', $listPosts);
    }
}