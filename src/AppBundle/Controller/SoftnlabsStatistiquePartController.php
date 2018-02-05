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
use AppBundle\Form\TicketStatistique;

class SoftnlabsStatistiquePartController extends Controller
{
    /**
     * @Route("/", name="softnlabs")
     */
    public function indexAction(Request $request)
    {
        $StatistiqueForm = $this->createForm(TicketStatistique::class);
        $StatistiqueForm->handleRequest($request);
        $formView = $StatistiqueForm->createView();


        /*// Permet de montrer le format nécessaire pour que les données soient intégrés aux graphes
        $session = $request->getSession();
        $object1 = (object) [
            'name'=>'Bloquant',
            'y' => 1,
        ];
        $object2 = (object) [
            'name'=>'Urgent',
            'y' => 2,
        ];
        $tabex= array($object1);
        array_push($tabex,$object2);
        $session->set('tableauCriticite', $tabex);*/

        if (!is_null($StatistiqueForm["definition"]->getData())) {
            $em = $this->getDoctrine()->getManager();
            //On récupère dans un tableau les criticités sélectionner dans le formulaire
            $tab1 = $StatistiqueForm["definition"]->getData();

            //On initialise le tableau
            $tableaustatut = array();

            //On veut parcourir les différentes criticités qui ont été sélectionner dans le formulaire
            foreach ($tab1 as $value1) {

                //On a normalement en résultat 2 éléments : le nom de la criticité et le nombre de ticket ayant cette criticité
                $nombreStatut = $this->getDoctrine()->getRepository(Ticket::class)->trouverNombreStatut($value1);

                $objectSelectionne = (object)[
                    //Permet de transférer dans l'objet le nom de la criticité
                    'name' => $value1->getDefinition(),
                    //Permet de transférer dans l'objet le nombre de ticket ayant cette criticité
                    'y' => intval($nombreStatut),
                ];
                //On ajoute dans le tableau un objet contenant les statistiques
                array_push($tableaustatut, $objectSelectionne);
            }

            // On met en variable de session le tableau contenant les statistiques lié à la criticité
            $session = $request->getSession();
            $session->set('tableauStatut', $tableaustatut);
        }

        if (!is_null($StatistiqueForm["chaine"]->getData())) {
            $em = $this->getDoctrine()->getManager();
            //On récupère dans un tableau les criticités sélectionner dans le formulaire
            $tab = $StatistiqueForm["chaine"]->getData();

            //On initialise le tableau
            $tableaucriticite = array();

            //On veut parcourir les différentes criticités qui ont été sélectionner dans le formulaire
            foreach ($tab as $value) {

                //On a normalement en résultat 2 éléments : le nom de la criticité et le nombre de ticket ayant cette criticité
                $nombreCritique = $this->getDoctrine()->getRepository(Ticket::class)->trouverNombreCriticite($value);

                $objectSelectionne = (object)[
                    //Permet de transférer dans l'objet le nom de la criticité
                    'name' => $value->getChaine(),
                    //Permet de transférer dans l'objet le nombre de ticket ayant cette criticité
                    'y' => intval($nombreCritique),
                ];
                //On ajoute dans le tableau un objet contenant les statistiques
                array_push($tableaucriticite, $objectSelectionne);
            }

            // On met en variable de session le tableau contenant les statistiques lié à la criticité
            $session = $request->getSession();
            $session->set('tableauCriticite', $tableaucriticite);
        }

        if (!is_null($StatistiqueForm["description"]->getData())) {
            $em = $this->getDoctrine()->getManager();
            //On récupère dans un tableau les criticités sélectionner dans le formulaire
            $tab3 = $StatistiqueForm["description"]->getData();

            //On initialise le tableau
            $tableauorganisation = array();

            //On veut parcourir les différentes criticités qui ont été sélectionner dans le formulaire
            foreach ($tab3 as $value3) {

                //On a normalement en résultat 2 éléments : le nom de la criticité et le nombre de ticket ayant cette criticité
                $nombreCritique = $this->getDoctrine()->getRepository(Ticket::class)->trouverNombreOrganisation($value3);

                $objectSelectionne = (object)[
                    //Permet de transférer dans l'objet le nom de la criticité
                    'name' => $value3->getDescription(),
                    //Permet de transférer dans l'objet le nombre de ticket ayant cette criticité
                    'y' => intval($nombreCritique),
                ];
                //On ajoute dans le tableau un objet contenant les statistiques
                array_push($tableauorganisation, $objectSelectionne);
            }

            // On met en variable de session le tableau contenant les statistiques lié à la criticité
            $session = $request->getSession();
            $session->set('tableauOrganisation', $tableauorganisation);
        }

        return $this->render('default/softnlabs_statistique_part.html.twig', array(
            'mon_formulaire' => $formView
        ));
    }
}
