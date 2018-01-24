<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 12/12/2017
 * Time: 11:40
 */

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use AppBundle\Entity\Ticket;
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
        $session = $request->getSession();
        $user_id = $session->get('userID');

        //Ces lignes devront être décommentées pour la version définitive
        /*
        $tickets = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Ticket')->findBy(array("idutilClient"=>$user_id));
        // replace this example code with whatever you need
        if(!$tickets){
            return error_log("Pas marché");
        }
        return $this->render('default/client.html.twig', array('tickets'=>$tickets));
        */

        return $this->render('default/client.html.twig');
    }
}
