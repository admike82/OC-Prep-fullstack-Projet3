<?php

namespace App\Log;

use \Fram\Application;

class LogApplication extends Application
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Log';
    }

    public function run()
    {
        if ($this->user->isAuthenticated()) {
            $this->httpResponse->redirect('/');
        }

        $controller = $this->getController();

        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}
