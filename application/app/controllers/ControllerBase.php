<?php

declare(strict_types=1);

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        // Disable View File Content
        $this->view->disable();

        // enable CORS
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
    }
}