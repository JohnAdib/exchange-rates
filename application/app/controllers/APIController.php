<?php

declare(strict_types=1);

use Phalcon\Http\Response;
use Phalcon\Http\Request;
use models\ExchangeModel;

class APIController extends ControllerBase
{
    public function indexAction()
    {
        $response = new Response();
        $request = new Request();

        if ($request->isGet()) {
            $returnData = (new ExchangeModel())->load();
            $response->setStatusCode($returnData->status, $returnData->msg);
            $response->setJsonContent($returnData);
        } else {
            $response->setStatusCode(405, 'Method Not Allowed');
            $response->setJsonContent(["okay" => false, "error" => "Method Not Allowed"]);
        }
        $response->send();
    }
}