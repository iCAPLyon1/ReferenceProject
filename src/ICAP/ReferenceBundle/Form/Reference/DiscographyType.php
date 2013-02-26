<?php

namespace ICAP\ReferenceBundle\Form\Reference;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DiscographyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', 'integer')
            ->add('language')
            ->add('artist')
            ->add('composer')
            ->add('duration', 'integer')
        ;
    }

    public function getName()
    {
        return 'discography';
    }
}