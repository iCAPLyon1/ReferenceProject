<?php

namespace ICAP\ReferenceBundle\Service\Reference;

class Bibliography extends AbstractReference
{
    protected $container;

    public function __construct($container) 
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function getFormType() 
    {
        //$formType = 
    }
}