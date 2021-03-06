<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 12/12/2017
 * Time: 11:40
 */

namespace AppBundle\Controller;

//Controller

use AppBundle\Entity\Statut;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\Utilisateur;
use AppBundle\Form\TicketAddType;
use AppBundle\Form\TicketViewClientLocked;
use AppBundle\Form\TicketViewClientStat;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class TicketViewClientController extends Controller
{
    /**
     * @Route("/", name="ticketViewClient")
     */
    public function indexAction(Request $request,$id)
    {
        //On récupère l'entity manager et la session
        $em = $this->getDoctrine()->getManager();
        $session = new Session();

        //création et initialisation du booléen isModalNeccesary - il définit dans le twig si on aura besoin
        //du Modal permettant d'ajouter Une justification et/ou le nombre de demi journées effectuées sur le ticket
        $isModalNecessary = false;

        //Récupération deu ticket à afficher grâce à son identifiant
        $ticket = $em->getRepository(Ticket::class)->find($id);


        //Le client ne peut modifier le statut du ticket que si celui ci est à nouveau
        if($ticket->getidstatut()->getDefinition()=="Nouveau"){

            //On récupère le formulaire créé précédemment
            $form = $this->createForm(TicketViewClientStat::class,$ticket);

            //Prise en charge de l'élément request, envoyé par le formulaire lors de sa soumission
            $form->handleRequest($request);

            //On génère le html du formulaire créé, il faudra ensuite injecter ce formulaire dans une vue
            $formView = $form->createView();

            $isModalNecessary = true;


        }else{

            //On récupère le formulaire créé précédemment
            $form = $this->createForm(TicketViewClientLocked::class,$ticket);

            //Prise en charge de l'élément request, envoyé par le formulaire lors de sa soumission
            $form->handleRequest($request);

            //On génère le html du formulaire créé, il faudra ensuite injecter ce formulaire dans une vue
            $formView = $form->createView();

        }

        if($form->isSubmitted() && $form->isValid()){

            //Récupération de la session et de l'entity manager
            $session = new Session();
            $em = $this->getDoctrine()->getManager();

            //On met à jour la BDD
            $em->persist($ticket);

            $em->flush();

            //On récupère le numéro d'identifiant de l'utilisateur en cours d'utilisation
            $user_id = $session->get('userID');
            $user = $em->getRepository(Utilisateur::class)->find($session->get('userID'));

            //On récupère les tickets du client qui se connecte afin de les afficher dans le tableau de tickets
            $tickets = $this
                ->getDoctrine()
                ->getRepository('AppBundle:Ticket')->findBy(array("idutilClient"=>$user));

            return $this->render('default/client.html.twig', array('tickets'=>$tickets));

        }

        //On renvoie la visualisation du ticket par le client
        return $this->render(':default:visualisation_ticket_client.html.twig', array('ticket'=>$ticket,'form'=>$formView,'isModalNecessary'=>$isModalNecessary));
    }
}