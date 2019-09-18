<?php

namespace App\Info;

use \Fram\Application;

class infoApplication extends Application
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Info';
    }

    public function run()
    {
        $controller = $this->getController();

        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}
