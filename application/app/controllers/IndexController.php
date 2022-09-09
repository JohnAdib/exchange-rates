<?php

declare(strict_types=1);

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        // disable view
        $this->view->disable();

        // redirect root to api
        $this->response->redirect('/api');
    }
}