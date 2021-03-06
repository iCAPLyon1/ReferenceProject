<?php

namespace ICAP\ReferenceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ICAP\ReferenceBundle\Form\ReferenceType;
use ICAP\ReferenceBundle\Entity\Reference;
use ICAP\ReferenceBundle\Entity\CustomField;

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
        $em = $this->getDoctrine()->getEntityManager();
        $references = $em->getRepository('ICAPReferenceBundle:Reference')->findAll();
        return array('references' => $references);
    }

    /**
     * @Route("/show/{id}", name="icap_reference_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $reference = $em->getRepository('ICAPReferenceBundle:Reference')->findOneBy(array('id' => $id));

        return array('reference' => $reference);
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

            return $this->redirect($this->generateUrl('icap_reference_show', array('id' => $reference->getId())));
        }

        return array(
            'type' => $type,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/new_custom_field/{id}", name="icap_reference_new_custom_field")
     * @Template()
     */
    public function newCustomFieldAction(Request $request, $id)
    {
        $form = $this->get('icap_reference.form_manager')->getCustomForm(new CustomField());

        return array(
            'id' => $id,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/create_custom_field/{id}", name="icap_reference_create_custom_field")
     * @Template("ICAPReferenceBundle:Default:newCustomField.html.twig")
     */
    public function createCustomFieldAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $reference = $em->getRepository('ICAPReferenceBundle:Reference')->findOneBy(array('id' => $id ));
        if(!$reference) {
            throw $this->createNotFoundException('The reference does not exist');
        }

        $customField = new CustomField();
        $form = $this->get('icap_reference.form_manager')->getCustomForm($customField);
        $form->bind($request);

        if($form->isValid()) {
            $customField->setReference($reference);
            $em->persist($customField);
            $em->flush();

            return $this->redirect($this->generateUrl('icap_reference_show', array('id' => $reference->getId())));
        }

        return array(
            'id' => $id,
            'form' => $form->createView()
        );
    }

    /**
     * Delete a Custom field.
     *
     * @Route("/delete_custom_field/{id}", name="icap_reference_delete_custom_field")
     * @Method("POST")
     */
    public function deleteCustomFieldAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $customField = $em->getRepository('ICAPReferenceBundle:CustomField')->find($id);
        if(!$customField) {
            throw $this->createNotFoundException('The customField does not exist');
        }

        $referenceId = $customField->getReference()->getId();
        if (!$customField) {
            throw $this->createNotFoundException('Unable to find CustomField customField.');
        }

        $em->remove($customField);
        $em->flush();

        return $this->redirect($this->generateUrl('icap_reference_show', array('id' => $referenceId)));
    }
}
 