<?php

namespace ICAP\ReferenceBundle\Service\Reference;

abstract class AbstractReference
{
    public function getForm() {

        return $this->getFormType()->createView();
    }

    public abstract function getFormType();
}