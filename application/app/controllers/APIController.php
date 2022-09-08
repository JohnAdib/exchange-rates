<?php
declare(strict_types=1);

use Phalcon\Http\Response;
use Phalcon\Http\Request;
use data\Exchange;
use xchange\Symbols;

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

            // check api key
            $Exchangerates_API_KEY = $this->config->application->Exchangerates_API_KEY;
            if(!$Exchangerates_API_KEY)
            {
                // Set status code
                $response->setStatusCode(405, 'Method Not Allowed');
                // Set the content of the response
                // $response->setContent("Sorry, the page doesn't exist");
                $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
                // Send response to the client
                $response->send();
                return;
            }

            // call model to get data
            $exchange = new Exchange($Exchangerates_API_KEY);
            $symbols = new Symbols();


            // Use Model for database Query
            $returnData = [
                "name" => "MrAdib",
                "test" => $exchange->aaa(),
                "symbols" => $symbols->getFamous(),
                "api" => $this->config->application->Exchangerates_API_KEY,
            ];

            // Set status code
            $response->setStatusCode(200, 'OK');
            // Set the content of the response
            $response->setJsonContent(["status" => true, "error" => false, "data" => $returnData ]);
            // Send response to the client
            $response->send();
            return;

        }

        // Set status code
        $response->setStatusCode(405, 'Method Not Allowed');
        // Set the content of the response
        // $response->setContent("Sorry, the page doesn't exist");
        $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        // Send response to the client
        $response->send();
    }
}