<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Utilisateur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
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


        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
