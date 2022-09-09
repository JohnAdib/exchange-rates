<?php

declare(strict_types=1);

use Phalcon\Http\Response;
use Phalcon\Http\Request;
use models\Exchange;


class APIController extends \Phalcon\Mvc\Controller
{

    /**
     * Simple GET API Request
     *
     * @method GET
     * @link /api/
     */
    // public function indexAction()
    public function indexAction()
    {
        // Disable View File Content
        $this->view->disable();

        // Getting a response instance
        // https://docs.phalcon.io/4.0/en/response.html
        $response = new Response();

        // Getting a request instance
        // https://docs.phalcon.io/4.0/en/request
        $request = new Request();

        // Check whether the request was made with method GET ( $this->request->isGet() )
        if ($request->isGet()) {
            // Check whether the request was made with Ajax ( $request->isAjax() )

            // call model to get data
            $exchange = new Exchange();
            $returnData = $exchange->load();

            // Set status code
            // $response->setStatusCode($returnData['status'], $returnData['error']);
            $response->setStatusCode(200, 'OK');
            // Set the content of the response
            $response->setJsonContent($returnData);
        } else {
            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');
            // Set the content of the response
            $response->setJsonContent(["okay" => false, "error" => "Method Not Allowed"]);
        }
        // Send response to the client
        $response->send();
    }
}