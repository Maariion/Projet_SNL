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
use AppBundle\Entity\Utilisateur;
use AppBundle\Repository\UtilisateurRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class SoftnlabsClientPartController extends Controller
{
    /**
     * @Route("/", name="softnlabsClientPartController")
     */
    public function indexAction(Request $request)
    {
        //Récupération de l'entity manager et de la session
        $em = $this->getDoctrine()->getManager();
        $session = new Session();

        //On vérifie le statut de l'utilisateur, Consultant ou administrateur, la variable prend vrai
        // si l'utilisateur est administrateur. Le booléen est enquite utilisé dans le .twig pour savoir si
        //
        if($session->get('userStatut')=="Admin"){
            $isAdmin = true;
        }else{
            $isAdmin = false;
        }

        //Récupération de tous les clients
        $clients= $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();

        // replace this example code with whatever you need
        return $this->render('default/softnlabs_client_part.html.twig', array('clients'=>$clients, 'isAdmin'=>$isAdmin));
    }

}