<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Location;
use Doctrine\ORM\Query\AST\WhereClause;
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
        $user=$this->getUser()->getId();
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

        return $this->render('location/index.html.twig', array(
            'locations' => $result,
            'user'=>$user,
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
        $favoris= $em->getRepository('AppBundle:Favoris')->findAll();

        $locations = $em->getRepository('AppBundle:Location')->findAll();
        if ($request->isMethod('POST')) {
            $prix = $request->get('prix');
            $type = $request->get('type');
            $equipement = $request->get('equipement');
                 $piece=$request->get('piece');
            $region = $request->get('region');
            $locations = $em->getRepository('AppBundle:Location')->findBy(
            [
                "type" => $type,
                "prix" =>$prix,
                "equipement"=>$equipement,
                "region"=>$region,
                "piece"=>$piece,


        ]
            );

        }
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $locations,
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 3)
        );
        return $this->render('location/searchLocation.html.twig', array(
            'locations' => $result,
         'favoris'=>$favoris
        ));

    }





}


