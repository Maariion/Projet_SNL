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

class SoftnlabsClientPartController extends Controller
{
    /**
     * @Route("/", name="softnlabsClientPartController")
     */
    public function indexAction(Request $request)
    {
        $clients = $this->getDoctrine()
            ->getRepository('AppBundle:Utilisateur')
            ->findAll();

        // replace this example code with whatever you need
        return $this->render('default/softnlabs_client_part.html.twig', array('clients'=>$clients));
    }

    public function myFindDQL($nomU, $nomO, $role)
    {
        $query =$this->_em->createQuery('select u.nom, o.nom, u.role from organisation o join utilisateur u on o.IDOrg=u.IDOrg');
        $query->setParameter('o.nom', $nomO);
        return $query
            ->getQuery()
            ->getResult()
            ;
    }
}