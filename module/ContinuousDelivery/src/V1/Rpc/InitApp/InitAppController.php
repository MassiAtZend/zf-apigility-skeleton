<?php
namespace ContinuousDelivery\V1\Rpc\InitApp;

use Zend\Mvc\Controller\AbstractActionController;

class InitAppController extends AbstractActionController
{
    public function initAppAction()
    {
        $r = new \Redis();
        $r->connect('redis-server');
        $r->flushAll();
        return ['ok' => true];
    }
}
