<?php

namespace ICAP\ReferenceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ICAP\ReferenceBundle\Form\ReferenceType;
use ICAP\ReferenceBundle\Entity\Reference;

class DefaultController extends Controller
{
    /**
     * @Route("/new", name="icap_reference_new")
     * @Template()
     */
    public function newAction()
    {
        $form = $this->createForm($this->get('icap_reference.choose_type'));
        //var_dump($this->container->getParameter('referencesConfiguration'));

        return array('form' => $form->createView());
    }

    /**
     * @Route("/", name="icap_reference_list")
     * @Template()
     */
    public function listAction()
    {
        $references = $this->container->get('icap_reference.manager')->getReferenceList();
        return array('references' => $references);
    }

    /**
     * @Route("/show")
     * @Template()
     */
    public function showAction()
    {
        return array();
    }

    /**
     * @Route("/choose_type", name="icap_reference_choose_type")
     * @Template("ICAPReferenceBundle:Default:new.html.twig")
     */
    public function chooseTypeAction(Request $request)
    {
        $form = $this->createForm($this->get('icap_reference.choose_type'));
        $form->bind($request);

        if($form->isValid()) {
            $data = $form->getData();
            $type = $data['type'];
            $url = $data['url'];

            if(!$type) {
                throw $this->createNotFoundException();
            }

            $reference = new Reference();
            $reference->setType($type);
            $reference->setUrl($url);
            $form = $this->get('icap_reference.form_manager')->getForm($type, $reference);
            $viewForm = $form->createView();

            if($request->isXMLHttpRequest()) {
                return $this->render('ICAPReferenceBundle:Default:newReferenceForm.html.twig', array(
                    'type' => $type,
                    'form' => $viewForm
                ));
            }

            return $this->render('ICAPReferenceBundle:Default:newReference.html.twig', array(
                'type' => $type,
                'form' => $viewForm
            ));
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/create_type/{type}", name="icap_reference_create_type")
     * @Template("ICAPReferenceBundle:Default:newReference.html.twig")
     */
    public function createTypeAction(Request $request, $type)
    {
        $reference = new Reference();
        $form = $this->get('icap_reference.form_manager')->getForm($type, $reference);
        $form->bind($request);
        if($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($reference);
            $em->flush();

            return $this->redirect($this->generateUrl('icap_reference_new'));
        }

        return array(
            'type' => $type,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/create_type/{type}", name="icap_reference_add_custom_input")
     * @Template("ICAPReferenceBundle:Default:newReference.html.twig")
     */
    public function addCustomInputAction(Request $request, $type)
    {
        $reference = new Reference();
        $form = $this->get('icap_reference.form_manager')->getForm($type, $reference, 1);
        $form->bind($request);
        if($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($reference);
            $em->flush();

            return $this->redirect($this->generateUrl('icap_reference_new'));
        }

        return array(
            'type' => $type,
            'form' => $form->createView()
        );
    }
}
 