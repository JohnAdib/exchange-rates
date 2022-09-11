<?php

declare(strict_types=1);

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class ControllerBase extends Controller
{
    public function initialize()
    {
        // Disable View File Content
        $this->view->disable();
        // enable CORS
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('X-POWERED-BY', 'MrAdib');
    }

    protected function methodNotAllowed()
    {
        $response = new Response();
        $response->setStatusCode(405, 'Method Not Allowed');
        $response->setJsonContent(["okay" => false, "error" => "Method Not Allowed"]);
        $response->send();
    }
}