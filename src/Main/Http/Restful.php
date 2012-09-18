<?php
namespace Main\Http;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Mvc\MvcEvent;

abstract class Restful
extends AbstractRestfulController{

    public function onDispatch(MvcEvent $e){
        if($e->getRequest()->isPost()) {
            $postOverride = $e->getRequest()->getServer("HTTP_X_HTTP_METHOD_OVERRIDE", false);
            switch ($postOverride){
                case "POST":
                    $e->getRequest()->setMethod('put'); //insert
                    break;
                case "DELETE":
                    $e->getRequest()->setMethod('delete');
                    break;
                case "PUT":
                    $e->getRequest()->setMethod('post'); //update
                    break;
                default:
                    $e->getRequest()->setMethod('put'); //insert
                    break;
            }
        }
        return parent::onDispatch($e);
    }
}