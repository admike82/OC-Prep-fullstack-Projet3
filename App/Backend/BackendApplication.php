<?php

namespace App\Backend;

use \Fram\Application;

class BackendApplication extends Application
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Backend';
    }

    public function run()
    {
        if ($this->user->isAuthenticated()) {
            $this->httpResponse->redirect('/');
        } else {
            $controller = $this->getController();
        }

        

        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}
