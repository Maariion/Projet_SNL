<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 13/12/2017
 * Time: 11:21
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Ticket;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Criticite;
use AppBundle\Form\CriticiteStat;

class SoftnlabsStatistiquePartController extends Controller
{
    /**
     * @Route("/", name="softnlabs")
     */
    public function indexAction(Request $request)
    {
        $criticiteForm = $this->createForm('AppBundle\Form\CriticiteStat');
        $criticiteForm->handleRequest($request);
        $formView = $criticiteForm->createView();

        // Permet de montrer le format nécessaire pour que les données soient intégrés aux graphes
//        $session = $request->getSession();
//        $object1 = (object) [
//            'name'=>'Bloquant',
//            'y' => 1,
//        ];
//        $object2 = (object) [
//            'name'=>'Urgent',
//            'y' => 2,
//        ];
//        $tabex= array($object1);
//        array_push($tabex,$object2);
//        $session->set('tableauCriticite', $tabex);

        $tab = [];

        if ($criticiteForm->isSubmitted() && $criticiteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //On récupère dans un tableau les criticités sélectionner dans le formulaire
            $tab=$criticiteForm["chaine"]->getData();

            //On initialise le tableau
            $tableaucriticite= array();

            //On veut parcourir les différentes criticités qui ont été sélectionner dans le formulaire
            foreach ($tab as $value){

                //On a normalement en résultat 2 éléments : le nom de la criticité et le nombre de ticket ayant cette criticité
                $nombreCritique= $this->getDoctrine()->getRepository(Ticket::class)->trouverNombreCriticite($value);

                $objectSelectionne = (object) [
                    //Permet de transférer dans l'objet le nom de la criticité
                    'name'=>$value->getChaine(),
                    //Permet de transférer dans l'objet le nombre de ticket ayant cette criticité
                    'y' => intval($nombreCritique),
                ];
                //On ajoute dans le tableau un objet contenant les statistiques
                array_push($tableaucriticite,$objectSelectionne);
            }

            // On met en variable de session le tableau contenant les statistiques lié à la criticité
            $session = $request->getSession();
            $session->set('tableauCriticite', $tableaucriticite);

            return $this->render('default/softnlabs_statistique_part.html.twig', array(
                'mon_formulaire'=>$formView, 'tab' => $tab
            ));
        }
        return $this->render('default/softnlabs_statistique_part.html.twig', array(
            'mon_formulaire'=>$formView, 'tab' => $tab
        ));
    }
}
