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
        $session = $request->getSession();


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

            $user->setActif(1);

            //a supprimer
            $session->set('userID', 1);

            //Hachage du mlot de passe du nouvel utilisateur en sha1
            $user->setMotpasse(sha1($user->getMotpasse()));

            $this->addFlash("error","Impossible de rajouter un client chez SoftNLabs.");

            if($user->getOrganisation()->getNom()=="SoftNLabs" && $user->getRole()=="Client"){
                return $this->render('default/creation_nouveau_client.html.twig', array('form'=>$formView));
            }

            $em->persist($user);

            $em->flush();

            $clients = $this->getDoctrine()
                ->getRepository('AppBundle:Utilisateur')
                ->findAll();



            return $this->render('default/softnlabs_client_part.html.twig', array('clients'=>$clients));

        }else{

        }

        $clients= $this->getDoctrine()->getRepository(Utilisateur::class)->findAllButNoConsultant();

        // renvoie la page avec son formulaire
        return $this->render('default/creation_nouveau_client.html.twig', array('form'=>$formView,'client'=>$clients));
    }
}