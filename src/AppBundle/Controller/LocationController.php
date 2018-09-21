<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Location controller.
 *
 * @Route("/location")
 */
class LocationController extends Controller
{
    /**
     * Lists all location entities.
     *
     * @Route("/", name="location_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locations = $em->getRepository('AppBundle:Location')->findAll();

        return $this->render('location/index.html.twig', array(
            'locations' => $locations,
        ));
    }


    /**
     * Creates a new location entity.
     *
     * @Route("/depose", name="location_depose")
     * @Method({"GET", "POST"})
     */
    public function deposeAction(Request $request)
    {
        $location = new Location();
        $form = $this->createForm('AppBundle\Form\LocationType', $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();
            return $this->forward('fos_user.security.controller:loginAction');

        }

        return $this->render('location/depose.html.twig', array(
            'location' => $location,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new location entity.
     *
     * @Route("/new", name="location_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $location = new Location();
        $form = $this->createForm('AppBundle\Form\LocationType', $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();

            return $this->redirectToRoute('location_index', array('id' => $location->getId()));
        }

        return $this->render('location/new.html.twig', array(
            'location' => $location,
            'form' => $form->createView(),
        ));
    }

//    /**
//     * Finds and displays a location entity.
//     *
//     * @Route("/{id},{location}", name="location_show")
//     * @Method("GET")
//     */
//
//
//    public function showAction(Location $location)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $location=$em->getRepository('AppBundle:Location')->find($id);
//        return $this->render('location/location_index.twig', array(
//            'location' => $location,
//        ));
//
//    }

    /**
     * @param Request $request
     * @param Location $location
     *
     * @Route("/edit/{location}", name="location_edit")
     */
    public function editAction(Request $request, Location $location)
    {
        $editForm = $this->createForm('AppBundle\Form\LocationType', $location);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('location_index');

        }

        return $this->render('location/edit.html.twig', array(
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * @param Request $request
     * @param Location $location
     *
     * @Route("/delete/{location}", name="location_delete")
     */
    public function deleteAction(Request $request, Location $location)
    {

        if ($location == null) {
            return $this->redirectToRoute('location_index');
        }


        $em = $this->getDoctrine()->getManager();
        $em->remove($location);
        $em->flush();


        return $this->redirectToRoute('location_index');
    }


    /**
     * @Route("/search", name="location_search")
     */
    public function searchLocationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locations = $em->getRepository('AppBundle:Location')->findAll();
        if ($request->isMethod('POST')) {
            $type = $request->get('type');
            $locations = $em->getRepository('AppBundle:Location')->findBy(
                array(
                    "type" => $type
                ));
        }
        return $this->render('location/searchLocation.html.twig', array(
            'locations' => $locations
        ));

    }


}


