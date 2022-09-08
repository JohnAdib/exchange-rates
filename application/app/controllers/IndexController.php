<?php
declare(strict_types=1);

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        // disable view
        $this->view->disable();

        // $mySymbols = new \Symbols();
        // $famous = $mySymbols->getFamous();
        // echo json_encode($famous);
        echo json_encode([1,2,3,]);
    }
}