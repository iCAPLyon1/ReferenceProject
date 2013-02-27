<?php

namespace ICAP\ReferenceBundle\Form\Reference;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class DefaultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', 'integer')
            ->add('language')
        ;
    }

    public function getName()
    {
        return 'default';
    }
}