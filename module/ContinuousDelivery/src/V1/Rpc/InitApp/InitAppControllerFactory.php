<?php
namespace ContinuousDelivery\V1\Rpc\InitApp;

class InitAppControllerFactory
{
    public function __invoke($controllers)
    {
        return new InitAppController();
    }
}
