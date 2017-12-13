<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 12/12/2017
 * Time: 11:40
 */

namespace AppBundle\Controller;

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
        // replace this example code with whatever you need
        return $this->render('default/creation_nouveau_ticket.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}