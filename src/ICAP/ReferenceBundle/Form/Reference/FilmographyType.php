<?php

namespace ICAP\ReferenceBundle\Form\Reference;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FilmographyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', 'integer')
            ->add('language')
            ->add('director')
            ->add('synopsis', 'textarea')
            ->add('scenarist')
            ->add('publisher')
            ->add('producer')
            ->add('releaseDate', 'date')
            ->add('duration', 'integer')
        ;
    }

    public function getName()
    {
        return 'filmography';
    }
}