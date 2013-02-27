<?php

namespace ICAP\ReferenceBundle\Form\Reference;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BibliographyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', 'integer', array('required' => false ))
            ->add('language', null, array('required' => false ))
            ->add('author', null, array('required' => false ))
            ->add('summary', 'textarea', array('required' => false ))
            ->add('isbn', null, array('required' => false ))
            ->add('editor', null, array('required' => false ))
            ->add('publisher', null, array('required' => false ))
            ->add('pages', null, array('required' => false ))
        ;
    }

    public function getName()
    {
        return 'bibliography';
    }
}