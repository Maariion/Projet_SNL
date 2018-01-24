<?php
/**
 * Created by PhpStorm.
 * User: Pierre-Joseph
 * Date: 15/12/2017
 * Time: 11:17
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Utilisateur;
use AppBundle\Form\UtilisateurType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ConnexionController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {

        $session = $request->getSession();
        $session->invalidate();

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
                $session->set('userID', $user->getIdutil());

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