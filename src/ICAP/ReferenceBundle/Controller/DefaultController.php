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
        $form = $this->createForm(new ReferenceType());

        return array('form' => $form->createView());
    }
}
