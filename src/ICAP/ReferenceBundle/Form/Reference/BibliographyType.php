<?php

namespace ICAP\ReferenceBundle\Form\Reference;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BibliographyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', 'integer')
            ->add('language')
            ->add('author')
            ->add('summary', 'textarea')
            ->add('isbn')
            ->add('editor')
            ->add('publisher')
            ->add('pages')
        ;
    }

    public function getName()
    {
        return 'bibliography';
    }
}