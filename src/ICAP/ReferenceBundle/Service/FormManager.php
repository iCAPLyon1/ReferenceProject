<?php

namespace ICAP\ReferenceBundle\Service;

use ICAP\ReferenceBundle\Form\Reference\ReferenceType;

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

    public function getReferencesConfiguration()
    {
        return $this->getContainer()->getParameter('referencesConfiguration');
    }

    public function getForm($type, $reference = null)
    {
        return $this->getFormFactory()->create(
            new ReferenceType(),
            $reference,
            array('dataType' => $this->getServiceName($type))
        ); 
    }

    public function getServiceName($type)
    {
        $referencesConfiguration = $this->getReferencesConfiguration();
        $types = $referencesConfiguration['types'];

        return $types[$type]['service'];
    }
}