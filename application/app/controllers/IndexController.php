<?php

declare(strict_types=1);

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        // redirect root to api
        $this->response->redirect('/api');
    }
}