<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Utilisateur;
use AppBundle\Form\UtilisateurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /*
        $em = $this->getDoctrine()->getManager();

        $user = new Utilisateur();
        $user->setNom("Claude");
        $user->setPrenom("LeCoq");
        $user->setActif(1);
        $user->setMotpasse("mdp");
        $user->setOrganisationOid(2);
        $user->setRole("Consultant");
        $user->setMail("lol@gmail.com");


        $em->persist($user);

        $em->flush();
        */

        //On crée un nouvel utilisateur
        $user = new Utilisateur();

        //On récupère le formulaire créé précédemment
        $form = $this->createForm(UtilisateurType::class,$user);

        //Prise en charge de l'élément request, envoyé par le formulaire lors de sa soumission
        $form->handleRequest($request);

        //Si le formulaire a été soumis
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return new Response('Utilisateur ajouté');
        }

        //On génère le html du formulaire créé, il faudra ensuite injecter ce formulaire dans une vue
        $formView = $form->createView();

        //On rend la vue, on passe en paramètre le html généré au dessus. Le mot 'form' est utilisé dans le html pour retrouver les bonnes data dans le tableau
        return $this->render('default/index.html.twig', array('form'=>$formView));

    }
}
