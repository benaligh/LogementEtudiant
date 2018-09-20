<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\RegistreEtdType;
use AppBundle\Form\RegistreParticulierType;
use AppBundle\Form\RegistreProfessionnelType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegisterUserController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }


    /**
     * @Route("/addEtd",name="addEtd")
     */
    public function AddEtudiantAction(Request $request)
    {

        $user = new User();
        $form = $this->createForm(RegistreEtdType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $etudiant = $form->getData();
            $etudiant->addRole('ROLE_ETUDIANT');
            $etudiant->setEnabled(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->forward('fos_user.security.controller:loginAction');
        } else {
            return $this->render('@App/Users/registre_etudiant.html.twig', array(
                'form' => $form->createView()
            ));
        }
    }


    /**
     * @Route("/addPrt",name="addPrt")
     */
    public function AddPartclAction(Request $request)
    {

        $user = new User();
        $form = $this->createForm(RegistreParticulierType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $particulier = $form->getData();
            $particulier->addRole('ROLE_PARTICULIER');
            $particulier->setEnabled(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->forward('fos_user.security.controller:loginAction');
        } else {
            return $this->render('@App/Users/registre_particulier.html.twig', array(
                'form' => $form->createView()
            ));
        }
    }


    /**
     * @Route("/addPrfs",name="addPrfs")
     */
    public function AddProfsAction(Request $request)
    {

        $user = new User();
        $form = $this->createForm(RegistreProfessionnelType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $professionnel = $form->getData();
            $professionnel->addRole('ROLE_PROFESSIONNEL');
            $professionnel->setEnabled(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->forward('fos_user.security.controller:loginAction');
        } else {
            return $this->render('@App/Users/registre_professionnel.html.twig', array(
                'form' => $form->createView()
            ));
        }
    }

}
