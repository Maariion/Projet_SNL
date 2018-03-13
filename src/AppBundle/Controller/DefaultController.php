<?php

namespace AppBundle\Controller;

//Controller de la page de connexion

use AppBundle\Entity\Utilisateur;
use AppBundle\Form\UtilisateurAddType;
use AppBundle\Form\UtilisateurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $session=$request->getSession();
        $session->invalidate();

        //On crée un nouvel utilisateur
        $user = new Utilisateur();

        //On récupère le formulaire créé précédemment
        $form = $this->createForm(UtilisateurType::class,$user);

        //Prise en charge de l'élément request, envoyé par le formulaire lors de sa soumission
        $form->handleRequest($request);

        //On génère le html du formulaire créé, il faudra ensuite injecter ce formulaire dans une vue
        $formView = $form->createView();

        //Si le formulaire a été soumis
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();

            $userMail = $form -> getData()-> getMail();
            $userPwd = $form -> getData() -> getMotpasse();
            $userPwd = sha1($userPwd);

            $user=$em->getRepository(Utilisateur::class)->findOneBy(array('mail'=>$userMail,'motpasse'=>$userPwd));

            //Rajouter un message d'erreur si la connexion n'a pas pu être effectuée
            if(is_null($user)){
                return $this->render('default/index.html.twig', array('form'=>$formView));
            }
            else
            {
                //$session = $request->getSession();
                $session = new Session();

                $session->set('userID', $user->getId());
                $session->set('NomAndPrenom', $user->getNomAndPrenom());
                $session->set('userStatut',$user->getRole());
                $session->set('user', $user);

                if (strpos($userMail, 'softnlabs') != true) {
                    $user = $em->getRepository(Utilisateur::class)->find($session->get('userID'));

                    //On récupère les tickets du client qui se connecte afin de les afficher dans le tableau de tickets
                    $tickets = $this
                        ->getDoctrine()
                        ->getRepository('AppBundle:Ticket')->findBy(array("idutilClient"=>$user));

                    //On renvoie la page avec le tableau de tickets du client
                    return $this->render('default/client.html.twig', array('tickets'=>$tickets));
                } else {

                    $em = $this->getDoctrine()->getManager();

                    $session = new Session();

                    //On vérifie le statut de l'utilisateur, Consultant ou administrateur, la variable prend vrai si l'utilisateur est administrateur
                    if($session->get('userStatut')=="Admin"){
                        $isAdmin = true;
                    }else{
                        $isAdmin = false;
                    }

                    $clients= $this->getDoctrine()->getRepository(Utilisateur::class)->findAllButNoConsultant();

                    return $this->render('default/softnlabs_client_part.html.twig', array('clients'=>$clients, 'isAdmin'=>$isAdmin));
                }
            }
        }

        //On rend la vue, on passe en paramètre le html généré au dessus. Le mot 'form' est utilisé dans le html pour retrouver les bonnes data dans le tableau
        return $this->render('default/index.html.twig', array('form'=>$formView));

    }


}
