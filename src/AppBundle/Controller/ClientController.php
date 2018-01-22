<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 12/12/2017
 * Time: 11:40
 */

namespace AppBundle\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller
{
    /**
     * @Route("/", name="client")
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
        return $this->render('default/client.html.twig', array('clients'=>$clients));
    }
}
