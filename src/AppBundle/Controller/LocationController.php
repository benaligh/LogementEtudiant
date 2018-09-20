<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Location;
use AppBundle\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class LocationController extends Controller
{

    /**
     * @Route("/list" ,name="list_locations")
     */
    public function showAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Location');
        $locations = $repository->findAll();
        return $this->render('@App/Location/list.html.twig', array(
            'locations' => $locations

        ));
    }



    /**
     * @Route("/deposeAnnoce",name="deposeAnnoce")
     */
    public function deposeAnnoceAction(Request $request)
    {
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['photo']->getData();
            $newPhotoName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('annonce_photos'), $newPhotoName);

            $location = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();
            return $this->forward('AppBundle:Location:show');
        } else {
            return $this->render('@App/Location/deposeAnnoce.html.twig',
                array(
                    'form' => $form->createView()
                )
            );
        }
    }

    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:Location:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/update")
     */
    public function updateAction()
    {
        return $this->render('AppBundle:Location:update.html.twig', array(
            // ...
        ));
    }

}
