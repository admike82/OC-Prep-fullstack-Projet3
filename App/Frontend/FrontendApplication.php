<?php

namespace App\Frontend;

use Fram\Application;

class FrontendApplication extends Application
{

    public function __construct()
    {
        parent::__construct();

        $this->name = 'Frontend';
    }

    /**
     * Lancement du composent Frontend
     *
     * @return void
     */
    public function run()
    {
        if (!$this->user->isAuthenticated()) {
            $this->httpResponse->redirect('/connexion/');
        }

        $controller = $this->getController();
        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}
