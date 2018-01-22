<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 13/12/2017
 * Time: 11:20
 */

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SoftnlabsClientPartController extends Controller
{
    /**
     * @Route("/", name="softnlabsClientPartController")
     */
    public function indexAction(Request $request)
    {
        $clients = $this->getDoctrine()
            ->getRepository('AppBundle:Utilisateur')
            ->findAll();

        if(!$clients){
            throw $this->createNotFoundException(
                "Aucun client n'a été trouvé"
            );
        }

        // replace this example code with whatever you need
        return $this->render('default/softnlabs_client_part.html.twig', array('clients'=>$clients));

    }
}