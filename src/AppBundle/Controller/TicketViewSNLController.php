<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 12/12/2017
 * Time: 11:40
 */

namespace AppBundle\Controller;

//Controller de la page de visualisation d'un ticket côté SoftNLabs

use AppBundle\Entity\Statut;
use AppBundle\Entity\Ticket;
use AppBundle\Form\TicketViewSNLCons;
use AppBundle\Form\TicketViewSNLConsStatType;
use AppBundle\Form\TicketViewSNLLocked;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class TicketViewSNLController extends Controller
{
    /**
     * @Route("/", name="ticketViewSNL")
     */
    public function indexAction(Request $request,$id)
    {
        //Récupération de l'entity manager et de la session
        $em = $this->getDoctrine()->getManager();
        $session = new Session();

        //création et initialisation du booléen isModalNeccesary - il définit dans le twig si on aura besoin
        //du Modal permettant d'ajouter Une justification et/ou le nombre de demi journées effectuées sur le ticket
        $isModalNecessary = false;

        //Récupération deu ticket à afficher grâce à son identifiant
        $ticket = $em->getRepository(Ticket::class)->find($id);

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

        } //si le ticket est en cours, tous les utilisateurs SoftNLabs peuvent modifier le consultant et le statut

        elseif ($ticket->getidstatut()->getDefinition()=="En cours"){

            $form = $this->createForm(TicketViewSNLConsStatType::class,$ticket);
            $form->handleRequest($request);
            $formView = $form->createView();

            $isModalNecessary = true;

        }else{

            //Sinon le ticket est cloturé ou annulé et n'est modifiable en rien
            $form = $this->createForm(TicketViewSNLLocked::class,$ticket);
            $form->handleRequest($request);
            $formView = $form->createView();

        }

        //Lorsque d'éentulles modifications sont faites sur le ticket visualisé
        if($form->isSubmitted() && $form->isValid()){

            //On récupère la session et l'entity manager
            $session = new Session();
            $em = $this->getDoctrine()->getManager();

            //si le ticket est en nouveau et que l'utilisateur "Aucun user" a été changé, on passe le statut à "en cours"
            //on met également à jour le temps de prise en compte dans la base
            if($ticket->getIDStatut()==$em->find(Statut::class,1) && $ticket->getIdutilConsultant()!='-1'){
                $ticket->setIdStatut($em->find(Statut::class,2));
                $ticket->setTpsPriseCompte(new \DateTime());
            }

            //On met à jour le ticket en base
            $em->persist($ticket);
            $em->flush();

            //On vérifie le statut de l'utilisateur, Consultant ou administrateur, la variable
            // prend vrai si l'utilisateur est administrateur
            if($session->get('userStatut')=="Admin"){
                $isAdmin = true;
            }else{
                $isAdmin = false;
            }

            //On récupère la liste des tickets à afficher
            $tickets = $this->getDoctrine()
                ->getRepository('AppBundle:Ticket')
                ->findAll();

            //On renvoie la page de tickets de SNL
            return $this->render('default/softnlabs_ticket_part.html.twig', array('tickets'=>$tickets));
        }

        //On visualise le ticket
        return $this->
        render('default/visualisation_ticket_softnlabs.html.twig', array(
            'ticket'=>$ticket,
            'form'=>$formView,
            'isModalNecessary'=>$isModalNecessary
        ));

    }
}