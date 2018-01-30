<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 12/12/2017
 * Time: 11:40
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Ticket;
use AppBundle\Entity\Utilisateur;
use AppBundle\Form\TicketAddType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NouveauTicketController extends Controller
{
    /**
     * @Route("/", name="nouveauTicket")
     */
    public function indexAction(Request $request)
    {

        //On crée un nouvel utilisateur
        $ticket = new Ticket();

        //On récupère le formulaire créé précédemment
        $form = $this->createForm(TicketAddType::class,$ticket);

        //Prise en charge de l'élément request, envoyé par le formulaire lors de sa soumission
        $form->handleRequest($request);

        $session = $request->getSession();
        $ticket->setIdutilClient($session->get('user'));

        //On génère le html du formulaire créé, il faudra ensuite injecter ce formulaire dans une vue
        $formView = $form->createView();

        //Si le formulaire a été soumis
        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();


            //Récupération des informations transmises par le formulaire
            /*
            $ticket->setTitre($form->getData()->getTitre());
            $ticket->setDescription($form->getData()->getDescription());
            $ticket->setIdsys($form->getData()->getIDSys()->getIDSys());
            $ticket->setIdcrit($form->getData()->getIDCrit()->getIDCrit());
            $ticket->setIdtyp($form->getData()->getIDTyp()->getIDTyp());
            $ticket->setIdutilClient($session->get('userID'));

            $ticket->setIdsta(1);
            //$ticket->setIdutilClient(1);
            $ticket->setIdutilConsultant(1);

            //$ticket->setTpsprisecompte();
            //$ticket->setTpsresolution();
            */

            $em->persist($ticket);

            $em->flush();

            return $this->render('default/client.html.twig');

        }

        // replace this example code with whatever you need
        return $this->render('default/creation_nouveau_ticket.html.twig', array('form'=>$formView));
    }
}