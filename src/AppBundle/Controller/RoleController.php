<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RoleController
 * @package AppBundle\Controller
 */
class RoleController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->IsGranted('ROLE_ADMIN')) {
            return $this->forward('AppBundle:Location:adminLocation');
        }
        if ($this->get('security.authorization_checker')->IsGranted('ROLE_ETUDIANT')) {
            return $this->forward('AppBundle:Location:index');
        }
        if ($this->get('security.authorization_checker')->IsGranted('ROLE_PARTICULIER')) {
            return $this->forward('AppBundle:Location:index');
        }
        if ($this->get('security.authorization_checker')->IsGranted('ROLE_PROFESSIONNEL')) {
            return $this->forward('AppBundle:Location:index');
        } else {
            return $this->render('AppBundle:Role:homepage.html.twig');

        }

    }

    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/etudiant/",name="etudiant_page")
     * @Security("has_role('ROLE_ETUDIANT')")
     */
    public function etudiantPageAction()
    {
        return $this->render('AppBundle:Role:etudiant.html.twig');
    }

    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/",name="admin_page")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function adminPageAction()
    {
        return $this->render('AppBundle:Role:admin.html.twig');
    }

    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/particulier/",name="particulier_page")
     * @Security("has_role('ROLE_PARTICULIER')")
     */
    public function particulierPageAction()
    {
        return $this->render('AppBundle:Role:particulier.html.twig');
    }

    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/professionnel/",name="professionnel_page")
     * @Security("has_role('ROLE_PROFESSIONNEL')")
     */
    public function professionnelPageAction()
    {
        return $this->render('AppBundle:Role:professionnel.html.twig');
    }

    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/login_ok",name="login_ok")
     * @Security("has_role('ROLE_USER')")
     */
    public function showInfoAction()
    {
        return $this->render('AppBundle:Role:login_success.html.twig');
    }

    /**
     * @Route("/editetd/{user}",name="editetd")
     */
    public function editProfileAction(Request $request, User $user)
    {
        $editForm = $this->createForm('AppBundle\Form\RegistreEtdType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('location_index');

        }

        return $this->render('AppBundle:Users:editEtd.html.twig', array(
            'edit_form' => $editForm->createView(),
        ));
    }
    /**
 * @Route("/editpro/{user}",name="editpro")
 */
    public function editProAction(Request $request, User $user)
    {
        $editForm = $this->createForm('AppBundle\Form\RegistreProfessionnelType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('location_index');

        }

        return $this->render('AppBundle:Users:editPro.html.twig', array(
            'edit_form' => $editForm->createView(),
        ));
    }
    /**
     * @Route("/editparti/{user}",name="editparti")
     */
    public function editPartiAction(Request $request, User $user)
    {
        $editForm = $this->createForm('AppBundle\Form\RegistreParticulierType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('location_index');

        }

        return $this->render('AppBundle:Users:editParti.html.twig', array(
            'edit_form' => $editForm->createView(),
        ));
    }
}
