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
use AppBundle\Form\TicketViewClientStat;
use AppBundle\Form\TicketViewSNLCons;
use AppBundle\Form\TicketViewSNLConsStatType;
use AppBundle\Form\TicketViewSNLLocked;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class TicketViewSNLController extends Controller
{
    /**
     * @Route("/", name="ticketViewSNL")
     */
    public function indexAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();

        //indique si le ticket visualisé pourra ou non être annulé. Est utilisé dans la gestion des formulaires
        $canBeCancelled = false;

        $ticket = $em->getRepository(Ticket::class)->find($id);

        $ticket_status = $ticket->getidstatut()->getDefinition();

        //Selon le statut du ticket (en cours/nouveau/etc...) et selon le statut de l'utilisateur (Admin/consultant)
        //Un formulaire différent sera utilisé donnant accès à des champs différents

        //Si le ticket est nouveau
        if($ticket->getidstatut()->getDefinition()=="Nouveau"){

            //Si le ticket est en nouveau, les admins peuvent modifier le consultant du ticket
            if($session->get('userStatut')=="Admin"){

                $form = $this->createForm(TicketViewSNLCons::class,$ticket);
                $form->handleRequest($request);
                $formView = $form->createView();


            }else{

                //Un ticket Nouveau n'est pas modifiable par les consultants, le formulaire devra donc être bloqué
                $form = $this->createForm(TicketViewSNLLocked::class,$ticket);
                $form->handleRequest($request);
                $formView = $form->createView();


            }

        } //si le ticket est en cours, tout le monde peut modifier le consultant et le statut

        elseif ($ticket->getidstatut()->getDefinition()=="En cours"){

            $form = $this->createForm(TicketViewSNLConsStatType::class,$ticket);
            $form->handleRequest($request);
            $formView = $form->createView();

        }else{

            //Sinon le ticket n'est modifiable en rien
            $form = $this->createForm(TicketViewSNLLocked::class,$ticket);
            $form->handleRequest($request);
            $formView = $form->createView();

        }

        if($form->isSubmitted() && $form->isValid()){

            $session = $request->getSession();
            $em = $this->getDoctrine()->getManager();

            //si le ticket est en nouveau et que l'utilisateur "Aucun user a été changé, on passe le statut à "encours"
            //on met également à jour le temps de prise en compte dans la base
            if($ticket->getIDStatut()==$em->find(Statut::class,1) && $ticket->getIdutilConsultant()!='-1'){
                $ticket->setIdStatut($em->find(Statut::class,2));
                $ticket->setTpsPriseCompte(new \DateTime());
            }

            //si le ticket est annulé



            $em->persist($ticket);
            $em->flush();

            //On vérifie le statut de l'utilisateur, Consultant ou administrateur, la variable prend vrai si l'utilisateur est administrateur
            if($session->get('userStatut')=="Admin"){
                $isAdmin = true;
            }else{
                $isAdmin = false;
            }

            $tickets = $this->getDoctrine()
                ->getRepository('AppBundle:Ticket')
                ->findAll();

            // replace this example code with whatever you need
            return $this->render('default/softnlabs_ticket_part.html.twig', array('tickets'=>$tickets));
        }

        return $this->
        render('default/visualisation_ticket_softnlabs.html.twig', array(
            'ticket'=>$ticket,
            'form'=>$formView,
        ));

    }
}