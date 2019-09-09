<?php

namespace App\Frontend\Modules\Acteurs;

use Fram\HTTPRequest;
use Fram\BackController;

class ActeursController extends BackController {
    
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Listes des acteurs');
        
    }
}