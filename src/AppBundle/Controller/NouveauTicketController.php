<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 12/12/2017
 * Time: 11:40
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Statut;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\Utilisateur;
use AppBundle\Form\TicketAddType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class NouveauTicketController extends Controller
{
    /**
     * @Route("/", name="nouveauTicket")
     */
    public function indexAction(Request $request)
    {

        //On crée un nouveau ticket
        $ticket = new Ticket();

        //On récupère le formulaire de création de ticket
        $form = $this->createForm(TicketAddType::class,$ticket);

        //Prise en charge de l'élément request, envoyé par le formulaire lors de sa soumission
        $form->handleRequest($request);

        //On génère le html du formulaire créé, il faudra ensuite injecter ce formulaire dans une vue
        $formView = $form->createView();

        //Si le formulaire a été soumis
        if($form->isSubmitted() && $form->isValid()){

            //On récupère la session et l'entity manager
            $session = new Session();
            $em = $this->getDoctrine()->getManager();

            //On instaure le client comme propriétaire du client
            $ticket->setIdutilClient($session->get('user'));

            //On affect le statut Nouveau au ticket
            $statut = $em->getRepository(Statut::class)->find(1);


            $user = $em->getRepository(Utilisateur::class)->find($session->get('userID'));

            $ticket->setIdstatut($statut);
            $ticket->setIdutilClient($user);

            $ticket->setTpscreation(new \DateTime());
            $user = $em->getRepository(Utilisateur::class)->find(-1);
            $ticket->setIdutilConsultant($user);


            //On met à jour la BDD
            $em->persist($ticket);

            $em->flush();

            //On récupère le numéro d'identifiant de l'utilisateur en cours d'utilisation
            $user = $em->getRepository(Utilisateur::class)->find($session->get('userID'));

            //On récupère les tickets du client qui se connecte afin de les afficher dans le tableau de tickets
            $tickets = $this
                ->getDoctrine()
                ->getRepository('AppBundle:Ticket')->findBy(array("idutilClient"=>$user));

            return $this->render('default/client.html.twig', array('tickets'=>$tickets));

        }

        // replace this example code with whatever you need
        return $this->render('default/creation_nouveau_ticket.html.twig', array('form'=>$formView));
    }
}