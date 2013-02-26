<?php

namespace ICAP\ReferenceBundle\Service;

use ICAP\ReferenceBundle\Form\Reference\ReferenceType;

class Manager
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

    public function getReferenceList()
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        return $em->getRepository('ICAPReferenceBundle:Reference')->findAll();
    }
}