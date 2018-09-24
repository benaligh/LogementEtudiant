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
    public function indexAction(Request $request )
    {
        $em = $this->getDoctrine()->getManager();

        $locations = $em->getRepository('AppBundle:Location')->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $locations,
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 2)
        );

        return $this->render('location/index.html.twig', array(
            'locations' => $result,
        ));

    }


    /**
     * Lists all location entities page visitors.
     *
     * @Route("/annonces", name="location_annonces")
     * @Method("GET")
     */
    public function AnnonceAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locations = $em->getRepository('AppBundle:Location')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $locations,
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 3)
        );


        return $this->render('location/annonceVisitor.html.twig', array(
            'locations' => $result,
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
            $file = $form['photo']->getData();
            $newImgName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('annonce_Photos'), $newImgName);
            $location->setPhoto($newImgName);
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
            $conecté=$this->getUser();
            $location->setUser($conecté);
            $file = $form['photo']->getData();
            $newImgName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('annonce_Photos'), $newImgName);
            $location->setPhoto($newImgName);
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

    /**
    * Finds and displays a location entity.
    *
    * @Route("show/{location}", name="location_show")
   * @Method("GET")
   */


    public function showAction(Request $request, Location $location)
    {
       $em = $this->getDoctrine()->getManager();
       $location=$em->getRepository('AppBundle:Location')->find($location);
        return $this->render('location/show.html.twig', array(
            'location' => $location,
        ));

    }

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
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $locations,
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 2)
        );
        return $this->render('location/searchLocation.html.twig', array(
            'locations' => $result
        ));

    }


//    /**
//     * @Route("/{page}", defaults={"page" = 1}, name="filter")
//     * @Route("/")
//     */
//    public function FilterAction(Request $request, $page)
//    {
//        $locations = new Location();
//
//        $form = $this->createForm(LocationType::class, $locations);
//
//        $session = $this->getRequest()->getSession();
//
//        if ($session->get('dql') == null) {
//            $session->set('dql', "SELECT a FROM AppBundle:Location a WHERE a.is_active = true");
//        }
//
//        if ($request->isMethod('POST')) {
//            $form->bind($request);
//
//            if ($form->isValid()) {
//                $dql = "SELECT a FROM AppBundle:Location a WHERE a.is_active = true";
//                $type = $locations->getType();
//                $equipement = $locations->getEquipement();
//                $etat = $locations->getEtat();
//                $piece = $locations->getPiece();
//                $surface = $locations->getSurface();
//                $DateDisp = $locations->getDateDisp();
//                $region = $locations->getRegion();
//
//                if (isset($type)) {
//                    $dql .= " AND a.type = '" . $locations->getType() . "'";
//                }
//                if (isset($equipement)) {
//                    $dql .= " AND a.equipement = '" . $locations->getEquipement() . "'";
//                }
//                if (isset($etat)) {
//                    $dql .= " AND a.etat = '" . $locations->getEtat() . "'";
//                }
//                if (isset($piece)) {
//                    $dql .= " AND a.piece = '" . $locations->getPiece() . "'";
//                }
//                if (isset($surface)) {
//                    $dql .= " AND a.surface = '" . $locations->getSurface() . "'";
//                }
//                if (isset($DateDisp)) {
//                    $dql .= " AND a.DateDisp = '" . $locations->getDateDisp() . "'";
//                }
//                if (isset($region)) {
//                    $dql .= " AND a.region = '" . $locations->getRegion() . "'";
//                }
//
//                $session->set('dql', $dql);
//            }
//        }
//
//        $em = $this->get('doctrine.orm.entity_manager');
//
//        $query = $em->createQuery($session->get('dql'));
//
//        $paginator = $this->get('knp_paginator');
//        $pagination = $paginator->paginate(
//            $query,
//            $this->get('request')->query->get('page', $page),
//            5
//        );
//
//        return $this->render('AppBundle:Role:homepage.html.twig', array(
//                'form' => $form->createView(),
//                'pagination' => $pagination
//            )
//        );
//    }

}


