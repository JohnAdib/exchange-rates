<?php

declare(strict_types=1);

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->response->redirect('/api');
    }
}