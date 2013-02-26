ReferenceBundle
========================

Welcome to the reference bundle - a Symfony2 bundle you can use to create bibliography, filmography, disography or create your own.

1) Add Reference Bundle to your project 
----------------------------------
TODO

2) Create your own reference type
-------------------------------------

In config.yml (app/config/config.yml or yourVendor/yourBundle/config/config.yml) create a
    icap_reference:
        types:
            your_reference_type:
                label: the name of your humanly understandable
                service: the_service_corresponding_to_your_type

Then create a class inherit from AbstractType
    
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\AbstractType;

    class DefaultType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            parent::buildForm($builder, $options);
            $builder
                //Here add your fields like other symfony form
                ->add('year', 'integer')
                ->add('language')
            ;
        }

        public function getName()
        {
            return 'the_service_corresponding_to_your_type';
        }
    }

Then open services.yml (app/config/services.yml or yourVendor/yourBundle/config/services.yml) create a 
    a_service_name_of_your_choice: 
        class: YourVendor\YourBundle\Path\To\Your\Type
        arguments: []
        tags:
            - { name: form.type, alias: the_service_corresponding_to_your_type }

That's all folks !
