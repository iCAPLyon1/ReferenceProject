<?php

namespace ICAP\ReferenceBundle\Service;

use ICAP\ReferenceBundle\Form\Reference\ReferenceType;
use ICAP\ReferenceBundle\Form\Reference\CustomFieldType;

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

    public function getForm($type, $reference = null, $customFields=0)
    {
        return $this->getFormFactory()->create(
            new ReferenceType(),
            $reference,
            array(
                'dataType' => $this->getServiceName($type)
            )
        ); 
    }

    public function getCustomForm($customField = null)
    {
        return $this->getFormFactory()->create(
            new CustomFieldType(),
            $customField
        ); 
    }

    public function getServiceName($type)
    {
        $referencesConfiguration = $this->getReferencesConfiguration();
        $types = $referencesConfiguration['types'];

        return $types[$type]['service'];
    }
}