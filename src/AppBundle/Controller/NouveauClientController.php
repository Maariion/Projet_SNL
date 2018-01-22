<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 12/12/2017
 * Time: 11:40
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Utilisateur;
use AppBundle\Form\UtilisateurAddType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NouveauClientController extends Controller
{
    /**
     * @Route("/", name="nouveauClient")
     */
    public function indexAction(Request $request)
    {
        //On crée un nouvel utilisateur
        $user = new Utilisateur();

        //On récupère le formulaire créé précédemment
        $form = $this->createForm(UtilisateurAddType::class,$user);

        //Prise en charge de l'élément request, envoyé par le formulaire lors de sa soumission
        $form->handleRequest($request);

        //On génère le html du formulaire créé, il faudra ensuite injecter ce formulaire dans une vue
        $formView = $form->createView();

        //Si le formulaire a été soumis
        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();

            $user = new Utilisateur();
            $user->setNom($form->getData()->getNom());
            $user->setPrenom($form->getData()->getPrenom());
            $user->setActif(1);
            $user->setMotpasse($form->getData()->getMotpasse());
            //le premier getIDOrg permet de récupérer l'entité Organisation depuis le formulaire, le second permet de
            // récupérer l'identifiant de l'organisation
            $user->setIdorg($form->getData()->getIDOrg()->getIDOrg());
            $user->setRole($form->getData()->getRole());
            $user->setMail($form->getData()->getMail());

            $em->persist($user);

            $em->flush();

            return $this->render('default/softnlabs_client_part.html.twig');

        }



        // replace this example code with whatever you need
        return $this->render('default/creation_nouveau_client.html.twig', array('form'=>$formView));
    }
}