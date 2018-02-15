<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 12/12/2017
 * Time: 11:40
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Organisation;
use AppBundle\Entity\Utilisateur;
use AppBundle\Form\OrganisationAddType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NouvelleSocieteController extends Controller
{
    /**
     * @Route("/", name="nouvelleSociete")
     */
    public function indexAction(Request $request)
    {

        //On crée un nouvel utilisateur
        $societe = new Organisation();

        //On récupère le formulaire créé précédemment
        $form = $this->createForm(OrganisationAddType::class,$societe);

        //Prise en charge de l'élément request, envoyé par le formulaire lors de sa soumission
        $form->handleRequest($request);

        //On génère le html du formulaire créé, il faudra ensuite injecter ce formulaire dans une vue
        $formView = $form->createView();

        //Si le formulaire a été soumis
        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();

            $societe = new Organisation();
            $societe->setNom($form->getData()->getNom());
            $societe->setDescription($form->getData()->getDescription());
            $societe->setActif(1);

            $em->persist($societe);

            $em->flush();

            return $this->render('default/softnlabs_client_part.html.twig');

        }

        $clients= $this->getDoctrine()->getRepository(Utilisateur::class)->findAllButNoConsultant();

        return $this->render('default/creation_nouvelle_societe.html.twig', array('form'=>$formView, 'clients'=>$clients));
    }
}