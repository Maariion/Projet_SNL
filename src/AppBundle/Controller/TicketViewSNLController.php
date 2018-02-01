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


class TicketViewSNLController extends Controller
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
        $form = $this->createForm(TicketViewSNL::class,$ticket);

        //Prise en charge de l'élément request, envoyé par le formulaire lors de sa soumission
        $form->handleRequest($request);

        //On génère le html du formulaire créé, il faudra ensuite injecter ce formulaire dans une vue
        $formView = $form->createView();

        return $this->render('default/visualisation_ticket_softnlabs.html.twig', array('ticket'=>$ticket,'form'=>$formView));


    }
}