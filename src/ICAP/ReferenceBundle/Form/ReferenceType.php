<?php

namespace ICAP\ReferenceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReferenceType extends AbstractType
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
        $types = $this->getContainer()->getParameter('referencesConfiguration')['types'];
        foreach ($types as $type => $typeConfig) {
            $referenceTypes[$typeConfig['service']] = $typeConfig['label'];
        }

        return $referenceTypes;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', 'url', array('property_path' => false))
            ->add('type', 'choice', array(
                'choices' => $this->getReferenceTypes(),
            ))
            ->add('title')
            ->add('description')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ICAP\ReferenceBundle\Entity\Reference'
        ));
    }

    public function getName()
    {
        return 'icap_referencebundle_referencetype';
    }
}
