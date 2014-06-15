<?php

namespace Acme\TaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\TaskBundle\Entity\Workers;
use Symfony\Component\HttpFoundation\Request;



class DefaultController extends Controller
{
    public function formAction(Request $request)
    {


        $worker = new Workers();


        $form = $this->createFormBuilder($worker)
            ->setAction($this->generateUrl('acme_form'))
            ->setMethod('GET')
            ->add('title', 'text')
            ->add('description', 'text')
            ->add('save', 'submit')
            ->getForm();


        $form->handleRequest($request);

        if ($form->isValid()) {

            $worker = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($worker);
            $em->flush();

            return $this->redirect($this->generateUrl('acme_add'));
        }

        return $this->render('AcmeTaskBundle:Default:form.html.twig', [
            'form' => $form->createView(),
        ]);



    }

    public function addAction() {

        return $this->render('AcmeTaskBundle:Default:add.html.twig');

    }


}
