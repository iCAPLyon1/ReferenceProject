<?php

namespace ICAP\ReferenceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChooseReferenceType extends AbstractType
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

    public function getReferenceTypes()
    {
        //key: serviceName
        //value: label 
        $referenceTypes = array();
        $configuration = $this->getContainer()->getParameter('referencesConfiguration');
        $types = $configuration['types'];
        foreach ($types as $type => $typeConfig) {
            $referenceTypes[$type] = $typeConfig['label'];
        }

        return $referenceTypes;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', 'url', array(
                'required' => false,
            ))
            ->add('type', 'choice', array(
                'choices' => $this->getReferenceTypes(),
                'preferred_choices' => array('default'),
                'empty_value' => 'choose a type',
                'empty_data' => null
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    }

    public function getName()
    {
        return 'icap_referencebundle_choosereferencetype';
    }
}
