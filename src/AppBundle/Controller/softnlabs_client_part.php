<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 13/12/2017
 * Time: 11:20
 */

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class softnlabs_client_part extends Controller
{
    /**
     * @Route("/", name="softnlabs_client_part")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/softnlabs_client_part.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}