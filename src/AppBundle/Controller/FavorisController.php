<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Favoris;
use AppBundle\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class FavorisController extends Controller
{
    /**
     * @Route("/listfavoris",name="listfavoris")
     */
    public function listfavorisAction( Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser()->getId();
        $favoris= $em->getRepository('AppBundle:Favoris')->findAll();
        $locations= $em->getRepository('AppBundle:Location')->findAll();

        return $this->render('AppBundle:Favoris:listfavoris.html.twig', array(
           'favoris'=>$favoris,
            'user' =>$user,
            'locations' =>$locations,

        ));
    }

    /**
     * @Route("/DeleteFavoris/{favoris}",name="deletefavoris")
     */
    public function DeleteFavorisAction( Request $request, Favoris $favoris)
    {

        if ($favoris == null) {
            return $this->redirectToRoute('');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($favoris);
        $em->flush();
        return $this->forward('AppBundle:Favoris:listfavoris');
    }

    /**
     * @Route("/ShowFavoris")
     */
    public function ShowFavorisAction()
    {
        return $this->render('AppBundle:Favoris:show_favoris.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/AddFavoris/{location}",name="addfavoris")
     */
    public function AddFavorisAction(Location $location)
    {
           $favoris=new Favoris();
           $favoris->setAnnonce($location->getId());
           $user=$this->getUser()->getId();
           $favoris->setUser($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($favoris);
        $em->flush();
        return $this->forward('AppBundle:Favoris:listfavoris');
    }

}
