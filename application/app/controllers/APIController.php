<?php

declare(strict_types=1);

use Phalcon\Http\Response;
use Phalcon\Http\Request;
use models\ExchangeModel;

class APIController extends ControllerBase
{
    public function indexAction()
    {
        $request = new Request();
        if ($request->isGet()) {
            $returnData = (new ExchangeModel())->load();
            $response = new Response();
            $response->setStatusCode($returnData->status, $returnData->msg);
            $response->setJsonContent($returnData);
            $response->send();
        } else {
            $this->methodNotAllowed();
        }
    }
}