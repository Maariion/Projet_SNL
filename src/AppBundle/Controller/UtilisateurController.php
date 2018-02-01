<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 19/12/2017
 * Time: 10:50
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Utilisateur;
use AppBundle\Form\UtilisateurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UtilisateurController
 * @package AppBundle\Controller
 */
class UtilisateurController extends Controller
{

    /**
     * @Route("/addUser", name="ajoutUtilisateur")
     *
     * @param Request $request
     * @return mixed
     */

    public function addAction(Request $request){
        //On crée un nouvel utilisateur
        $user = new Utilisateur();

        //On récupère le formulaire créé précédemment
        $form = $this->createForm(UtilisateurType::class,$user);

        //Prise en charge de l'élément request, envoyé par le formulaire lors de sa soumission
        $form->handleRequest($request);

        //Si le formulaire a été soumis
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $mail=$em->getRepository(Utilisateur::class)->findOneBy(array('mail'=>'clement@gmail.com'));
            return new Response(print_r($mail));
        }

        //On génère le html du formulaire créé, il faudra ensuite injecter ce formulaire dans une vue
        $formView = $form->createView();

        //On rend la vue, on passe en paramètre le html généré au dessus. Le mot 'form' est utilisé dans le html pour retrouver les bonnes data dans le tableau
        return $this->render('default/UtilisateurAdd.html.twig', array('form'=>$formView));
    }

    /**
     *
     * @Route ("/list", name="user_list")
     *
     * @return Response
     */
    public function userListAction(){
        $repository = $this->getDoctrine()->getRepository('AppBundle:Utilisateur');

        $users = $repository->findAll();

        return $this->render('default/userList.html.twig', array('users'=>$users));
    }


}