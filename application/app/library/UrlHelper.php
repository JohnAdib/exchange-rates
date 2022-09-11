<?php

namespace library;

use Phalcon\Http\Request;

class UrlHelper
{
    public function getParam(string $name): ?string
    {
        $request = new Request();
        return $request->getQuery($name);
    }
}