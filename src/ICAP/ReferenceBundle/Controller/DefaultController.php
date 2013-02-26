<?php

namespace ICAP\ReferenceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ICAP\ReferenceBundle\Form\ReferenceType;

class DefaultController extends Controller
{
    /**
     * @Route("/test")
     * @Template()
     */
    public function indexAction()
    {
        $form = $this->get('icap_reference.form_manager')->getForm();
        //var_dump($this->container->getParameter('referencesConfiguration'));

        return array('form' => $form->createView());
    }

    /**
     * @Route("/list")
     * @Template()
     */
    public function listAction()
    {
        return array();
    }

    /**
     * @Route("/new")
     * @Template()
     */
    public function newAction()
    {
        return array();
    }

    /**
     * @Route("/view")
     * @Template()
     */
    public function viewAction()
    {
        return array();
    }
}
