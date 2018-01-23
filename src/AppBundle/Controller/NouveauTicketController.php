<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 12/12/2017
 * Time: 11:40
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Ticket;
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

        //On génère le html du formulaire créé, il faudra ensuite injecter ce formulaire dans une vue
        $formView = $form->createView();

        //Si le formulaire a été soumis
        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();

            $ticket = new Ticket();
            $ticket->setTitre($form->getData()->getTitre());
            $ticket->setDescription($form->getData()->getDescription());


            $em->persist($ticket);

            $em->flush();

            return $this->render('default/client.html.twig');

        }

        // replace this example code with whatever you need
        return $this->render('default/client.html.twig', array('form'=>$formView));
    }
}