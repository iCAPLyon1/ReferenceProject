<?php

namespace ICAP\ReferenceBundle\Service;

use ICAP\ReferenceBundle\Form;

class FormManager
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

    public function getFormFactory()
    {
        return $this->getContainer()->get('form.factory');
    }

    public function getForm($serviceName = 'icap_reference.form_type')
    {
        return $this->getFormFactory()->create($this->getContainer()->get($serviceName)); 
    }
}