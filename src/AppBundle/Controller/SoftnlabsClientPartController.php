<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 13/12/2017
 * Time: 11:20
 */

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Organisation;
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
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        if(!$session->get('userID')){
            $session->set('userID',1);
            $session->set('NomAndPrenom', 'Morisset Clément');
        }

        $user_id = $session->get('userID');

        $clients = $this->getDoctrine()
            ->getRepository('AppBundle:Utilisateur')
            ->findAll();

        // replace this example code with whatever you need
        return $this->render('default/softnlabs_client_part.html.twig', array('clients'=>$clients));
    }

}