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
use AppBundle\Form\TicketViewClient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TicketViewClientController extends Controller
{
    /**
     * @Route("/", name="ticketViewClient")
     */
    public function indexAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();

        $ticket = $em->getRepository(Ticket::class)->find($id);

        $ticket_status = $ticket->getidstatut()->getDefinition();

        //On récupère le formulaire créé précédemment
        $form = $this->createForm(TicketViewClient::class,$ticket);

        //Prise en charge de l'élément request, envoyé par le formulaire lors de sa soumission
        $form->handleRequest($request);

        //On génère le html du formulaire créé, il faudra ensuite injecter ce formulaire dans une vue
        $formView = $form->createView();

        if($form->isSubmitted() && $form->isValid()){

            $session = $request->getSession();
            $em = $this->getDoctrine()->getManager();

            $statut = $form->getData()->getidstatut();

            if ($statut != $ticket_status){
                //On vérifie si le statut a changé, si oui on vérifie que le statut n'a pas été mis à clôturé ou en cours

            }

            $statut = $em->getRepository(Statut::class)->find(1);
            $user = $em->getRepository(Utilisateur::class)->find($session->get('userID'));
            $ticket->setIdstatut($statut);
            $ticket->setIdutilClient($user);

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

        return $this->render('default/visualisation_ticket_softnlabs.html.twig', array('ticket'=>$ticket,'form'=>$formView));


    }
}