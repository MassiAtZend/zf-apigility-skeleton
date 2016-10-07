<?php
namespace ContinuousDelivery\V1\Rest\ZendGS;

class ZendGSResourceFactory
{
    public function __invoke($services)
    {
        return new ZendGSResource(
            $services->get(\Application\Service\GSManager\GSManager::class)
        );
    }
}
