<?php

namespace AppBundle\Controller;

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

            $user=$em->getRepository(Utilisateur::class)->findOneBy(array('mail'=>$userMail,'motpasse'=>$userPwd));

            //Rajouter un message d'erreur si la connexion n'a pas pu être effectuée
            if(is_null($user)){
                return $this->render('default/index.html.twig', array('form'=>$formView));
            }
            {
                $session = $request->getSession();
                $session->set('userID', $user->getId());
                $session->set('user', $user);
                $session->set('NomAndPrenom', $user->getNomAndPrenom());
                $session->set('userStatut',$user->getidstatut);

                if (strpos($userMail, 'softnlabs') != true) {
                    return $this->render('default/client.html.twig');
                } else {
                    return $this->render('default/softnlabs_client_part.html.twig');
                }
            }
        }

        //On rend la vue, on passe en paramètre le html généré au dessus. Le mot 'form' est utilisé dans le html pour retrouver les bonnes data dans le tableau
        return $this->render('default/index.html.twig', array('form'=>$formView));

    }


}
