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
            $session->set('userStatut','Admin');
        }

        //On vérifie le statut de l'utilisateur, Consultant ou administrateur, la variable prend vrai si l'utilisateur est administrateur
        if($session->get('userStatut')=="Admin"){
            $isAdmin = true;
        }else{
            $isAdmin = false;
        }

        $clients= $this->getDoctrine()->getRepository(Utilisateur::class)->findAllButSoftnlabs();

        // replace this example code with whatever you need
        return $this->render('default/softnlabs_client_part.html.twig', array('clients'=>$clients, 'isAdmin'=>$isAdmin));
    }

}