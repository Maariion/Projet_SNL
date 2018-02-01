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
use AppBundle\Entity\Utilisateur;
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

        //Afin de faciliter le développement, on laisse la possibilité de se connecter automatiquement avec l'utilisateur 6
        //si aucun utilisateur n'a été renseigné
        $em = $this->getDoctrine()->getManager();

        $user=$em->getRepository(Utilisateur::class)->find(2);

        $session = $request->getSession();
        if(!$session->get('userID')){
            $session->set('userID',2);
            $session->set('NomAndPrenom', 'Sérazin Marion');
        }

        //On récupère le numéro d'identifiant de l'utilisateur en cours d'utilisation
        $user_id = $session->get('userID');
        $user = $em->getRepository(Utilisateur::class)->find($session->get('userID'));

        //On récupère les tickets du client qui se connecte afin de les afficher dans le tableau de tickets
        $tickets = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Ticket')->findBy(array("idutilClient"=>$user));

        /*
        // erreur si aucun ticket n'a été retrouvé
        if(!$tickets){
            return $this->render('default/client.html.twig');
        }
        */
        //On renvoie la page avec le tableau de tickets du client
        return $this->render('default/client.html.twig', array('tickets'=>$tickets));

        //return $this->render('default/client.html.twig');
    }
}
