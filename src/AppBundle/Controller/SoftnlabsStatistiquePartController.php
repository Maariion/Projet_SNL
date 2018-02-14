<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 13/12/2017
 * Time: 11:21
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Categorie;
use AppBundle\Entity\Organisation;
use AppBundle\Entity\Statut;
use AppBundle\Entity\Ticket;
use AppBundle\Entity\Utilisateur;
use AppBundle\Repository\StatutRepository;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Criticite;
use AppBundle\Form\TicketStatistique;
use Doctrine\Common\Collections\ArrayCollection;

class SoftnlabsStatistiquePartController extends Controller
{
    /**
     * @Route("/", name="softnlabs")
     */
    public function indexAction(Request $request)
    {

        /*
         * on récupère les années de création de ticket sans doublon car on doit transformer les datetime de la BDD en string comprenant les années
         * au format YYYY
         */
        $differenteAnnee=array();
        $x=0;
        $differenteDate = $this->getDoctrine()->getRepository(Ticket::class)->trouverLesAnnees();
        foreach ($differenteDate as $val){
            foreach ($val as $value) {
                foreach ($value as $v) {
                    if (($x%3)==0){
                        if($differenteAnnee==array()){
                            $date=substr($v,0,4);
                            array_push($differenteAnnee, $date);
                        }
                        if($differenteAnnee<>array()){
                            $date=substr($v,0,4);
                            $w=0;
                            foreach ($differenteAnnee as $df){
                                if ($date==$df){
                                    $w=$w+1;
                                }
                            }
                            if($w==0){
                                array_push($differenteAnnee, $date);
                            }
                        }
                    }
                    $x = $x+ 1;
                }
            }
        }

        /*
         * afin que les années se mettent bien dans le formulaire, il a été nécessaire que les clés des années soient égales aux années
         */
        $differenteAnneef=array();
        foreach ($differenteAnnee as $parcours){
            $differenteAnneef[$parcours]=$parcours;
        }

        /*
         * On crée la vue avec le formulaire et on envoie avec les années au bon format afin de les avaoir dans le formulaire
         */
        $StatistiqueForm = $this->createForm(TicketStatistique::class,null,array('annee'=>$differenteAnneef));
        $StatistiqueForm->handleRequest($request);
        $formView = $StatistiqueForm->createView();


        /* Permet de montrer le format nécessaire pour que les données soient intégrés aux graphes camembert
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

        if (!is_null($StatistiqueForm["annee"]->getData())) {
            $em = $this->getDoctrine()->getManager();
            //On récupère dans un tableau les années sélectionnées dans le formulaire
            $tab6 = $StatistiqueForm["annee"]->getData();


            //On initialise le tableau
            $tableauAnnee = array();

            //On veut parcourir les différentes années qui ont été sélectionnés dans le formulaire
            foreach ($tab6 as $value6) {

                //On a normalement en résultat 2 éléments : le nom de l'année et le nombre de ticket de cette année
                $nombreAnnee = $this->getDoctrine()->getRepository(Ticket::class)->trouverNombreAnnee($value6);

                $objectSelectionne = (object)[
                    //Permet de transférer dans l'objet l'année
                    'name' => $value6,
                    //Permet de transférer dans l'objet le nombre de ticket de cette année
                    'y' => intval($nombreAnnee),
                ];
                //On ajoute dans le tableau un objet contenant les statistiques
                array_push($tableauAnnee, $objectSelectionne);
            }

            // On met en variable de session le tableau contenant les statistiques liées à ces années
            $session = $request->getSession();
            $session->set('tableauAnnnee', $tableauAnnee);
        }


        if (!is_null($StatistiqueForm["definition"]->getData())) {
            $em = $this->getDoctrine()->getManager();
            //On récupère dans un tableau les statuts sélectionnés dans le formulaire
            $tab1 = $StatistiqueForm["definition"]->getData();

            //On initialise le tableau
            $tableaustatut = array();

            //On veut parcourir les différents statuts qui ont été sélectionnés dans le formulaire
            foreach ($tab1 as $value1) {

                //On a normalement en résultat 2 éléments : le nom du statut et le nombre de ticket ayant ce statut
                $nombreStatut = $this->getDoctrine()->getRepository(Ticket::class)->trouverNombreStatut($value1);

                $objectSelectionne = (object)[
                    //Permet de transférer dans l'objet le nom du statut
                    'name' => $value1->getDefinition(),
                    //Permet de transférer dans l'objet le nombre de ticket ayant ce statut
                    'y' => intval($nombreStatut),
                ];
                //On ajoute dans le tableau un objet contenant les statistiques
                array_push($tableaustatut, $objectSelectionne);
            }

            // On met en variable de session le tableau contenant les statistiques liées aux statuts
            $session = $request->getSession();
            $session->set('tableauStatut', $tableaustatut);
        }

        if (!is_null($StatistiqueForm["chaine"]->getData())) {
            $em = $this->getDoctrine()->getManager();
            //On récupère dans un tableau les criticités sélectionnées dans le formulaire
            $tab = $StatistiqueForm["chaine"]->getData();

            //On initialise le tableau
            $tableaucriticite = array();

            //On veut parcourir les différentes criticités qui ont été sélectionnées dans le formulaire
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

            // On met en variable de session le tableau contenant les statistiques liées aux criticitéx
            $session = $request->getSession();
            $session->set('tableauCriticite', $tableaucriticite);
        }

        if (!is_null($StatistiqueForm["categorie"]->getData())) {
            $em = $this->getDoctrine()->getManager();
            //On récupère dans un tableau les types sélectionnés dans le formulaire
            $tab = $StatistiqueForm["categorie"]->getData();

            //On initialise le tableau
            $tableaucategorie = array();

            //On veut parcourir les différents types qui ont été sélectionnés dans le formulaire
            foreach ($tab as $value4) {

                //On a normalement en résultat 2 éléments : le nom du type et le nombre de ticket ayant ce type
                $nombreCritique = $this->getDoctrine()->getRepository(Ticket::class)->trouverNombreType($value4);

                $objectSelectionne = (object)[
                    //Permet de transférer dans l'objet le nom du type
                    'name' => $value4->getNom(),
                    //Permet de transférer dans l'objet le nombre de ticket ayant ce type
                    'y' => intval($nombreCritique),
                ];
                //On ajoute dans le tableau un objet contenant les statistiques
                array_push($tableaucategorie, $objectSelectionne);
            }

            // On met en variable de session le tableau contenant les statistiques liées aux types
            $session = $request->getSession();
            $session->set('tableauType', $tableaucategorie);
        }

        if (!is_null($StatistiqueForm["nom"]->getData())) {
            $em = $this->getDoctrine()->getManager();
            //On récupère dans un tableau les organisations sélectionnées dans le formulaire
            $tab3 = $StatistiqueForm["nom"]->getData();


            //On initialise le tableau
            $tableauorganisation = array();

            //On veut parcourir les différente organisations qui ont été sélectionnées dans le formulaire
            foreach ($tab3 as $value3) {

                //On a normalement en résultat 2 éléments : le nom de l'organisation et le nombre de ticket ayant cette organisation
                $tousLesClients = $this->getDoctrine()->getRepository(Utilisateur::class)->trouverUtilisateurLieOrganisation($value3);
                $nombreCritique = $this->getDoctrine()->getRepository(Ticket::class)->trouverNombreOrganisation($tousLesClients);

                $objectSelectionne = (object)[
                    //Permet de transférer dans l'objet le nom de l'organisation
                    'name' => $value3->getNom(),
                    //Permet de transférer dans l'objet le nombre de ticket ayant cette organisation
                    'y' => intval($nombreCritique),
                ];
                //On ajoute dans le tableau un objet contenant les statistiques
                array_push($tableauorganisation, $objectSelectionne);
            }

            // On met en variable de session le tableau contenant les statistiques liées aux organisations
            $session = $request->getSession();
            $session->set('tableauOrganisation', $tableauorganisation);
        }


        // on récupère tous les tickets correspondants aux statistiques
        //on initialise tous les tableaux afin de pouvoir rentrer correctement dans les différents cas
        $tabType=new ArrayCollection();
        $tabCriticite=new ArrayCollection();
        $tabStatut=new ArrayCollection();
        $tousLesClients=array();
        $tabAnneeFinal=array();
        $tabOrganisation=new ArrayCollection();

        //Gestion des cas
        /*1 : on prend ce qui a été sélectionner sachant qu'une fois que l'on a sélectionné une fois dans le formulaire,
        * même si on a rien sélectionner le getData récupère des valeurs vides
        */
        /*2 : si le contenu du tableau est vide (car même si on a rien sélectionner le getData récupère des valeurs vides dans le cas)
        * et si on a rien mis dans le formulaire (1ère ouverture) => on prends toutes les valeurs possibles
        */
        /*
         * Particularité=> Les tickets étant lié aux utilisateurs on récupère tous les utilisateurs liés aux organisations sélectionnées
         */
        if (!is_null($StatistiqueForm["nom"]->getData())){
            $em = $this->getDoctrine()->getManager();
            $tabOrganisation = $StatistiqueForm["nom"]->getData();
            $tousLesClients = $this->getDoctrine()->getRepository(Utilisateur::class)->trouverTousUtilisateursLieOrganisation($tabOrganisation);
        }
        if($tabOrganisation->isEmpty() or !($StatistiqueForm["nom"]->isSubmitted()&& $StatistiqueForm["nom"]->isValid())) {
            $em = $this->getDoctrine()->getManager();
            $tousLesClients = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();
        }

        //Gestion des cas
        /*1 : on prend ce qui a été sélectionner sachant qu'une fois que l'on a sélectionné une fois dans le formulaire,
        * même si on a rien sélectionner le getData récupère des valeurs vides
        */
        /*2 : si le contenu du tableau est vide (car même si on a rien sélectionner le getData récupère des valeurs vides dans le cas)
        * et si on a rien mis dans le formulaire (1ère ouverture) => on prends toutes les valeurs possibles
        */
        if (!is_null($StatistiqueForm["categorie"]->getData())){
            $em = $this->getDoctrine()->getManager();
            $tabType = $StatistiqueForm["categorie"]->getData();
        }
        if($tabType->isEmpty() or !($StatistiqueForm["categorie"]->isSubmitted()&& $StatistiqueForm["categorie"]->isValid())) {
            $em = $this->getDoctrine()->getManager();
            $tabType = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        }

        //Gestion des cas
        /*1 : on prend ce qui a été sélectionner sachant qu'une fois que l'on a sélectionné une fois dans le formulaire,
        * même si on a rien sélectionner le getData récupère des valeurs vides
        */
        /*2 : si le contenu du tableau est vide (car même si on a rien sélectionner le getData récupère des valeurs vides dans le cas)
        * et si on a rien mis dans le formulaire (1ère ouverture) => on prends toutes les valeurs possibles
        */
        if (!is_null($StatistiqueForm["chaine"]->getData())){
            $em = $this->getDoctrine()->getManager();
            $tabCriticite = $StatistiqueForm["chaine"]->getData();
        }
        if($tabCriticite->isEmpty() or !($StatistiqueForm["chaine"]->isSubmitted()&& $StatistiqueForm["chaine"]->isValid())) {
            $em = $this->getDoctrine()->getManager();
            $tabCriticite = $this->getDoctrine()->getRepository(Criticite::class)->findAll();
        }

        //Gestion des cas
        /*1 : on prend ce qui a été sélectionner sachant qu'une fois que l'on a sélectionné une fois dans le formulaire,
        * même si on a rien sélectionner le getData récupère des valeurs vides
        */
        /*2 : si le contenu du tableau est vide (car même si on a rien sélectionner le getData récupère des valeurs vides dans le cas)
        * et si on a rien mis dans le formulaire (1ère ouverture) => on prends toutes les valeurs possibles
        */
        if (!is_null($StatistiqueForm["definition"]->getData())){
            $em = $this->getDoctrine()->getManager();
            $tabStatut = $StatistiqueForm["definition"]->getData();
        }
        if($tabStatut->isEmpty() or !($StatistiqueForm["definition"]->isSubmitted()&& $StatistiqueForm["definition"]->isValid())) {
            $em = $this->getDoctrine()->getManager();
            $tabStatut = $this->getDoctrine()->getRepository(Statut::class)->findAll();
        }

        //Gestion des cas
        /*1 : on prend ce qui a été sélectionner sachant qu'une fois que l'on a sélectionné une fois dans le formulaire,
        * même si on a rien sélectionner le getData récupère des valeurs vides
        */
        /*2 : si le contenu du tableau est vide (car même si on a rien sélectionner le getData récupère des valeurs vides dans le cas)
        * et si on a rien mis dans le formulaire (1ère ouverture) => on prends toutes les valeurs possibles (ici ce sont tous les tickets)
        */
        /*
         * Particularité=> Les données étant stockées sous forme de datetime on est obligé d'effectuer un traitement spécifique
         * car on part de strings et on veut tous les tickets correspondants à ces strings
         */
        $test5=($StatistiqueForm["annee"]->getData());
        if (!is_null($StatistiqueForm["annee"]->getData())){
            $em = $this->getDoctrine()->getManager();
            $tabAnnnee = $StatistiqueForm["annee"]->getData();
            foreach ($tabAnnnee as $ta){
                $tabAnnneebis = $this->getDoctrine()->getRepository(Ticket::class)->trouverTicketsLieAnnee($ta);
                foreach ($tabAnnneebis as $tabis){
                    array_push($tabAnneeFinal, $tabis);
                }
            }
        }

        if($test5==null or !($StatistiqueForm["annee"]->isSubmitted()&& $StatistiqueForm["annee"]->isValid())) {
            $em = $this->getDoctrine()->getManager();
            $tabAnneeFinal = $this->getDoctrine()->getRepository(Ticket::class)->trouverTousTickets();
        }

        //On récupère tous les tickets correspondants aux critères sélectionné ou tous les tickets si aucun critère n'est sélectionné
        $tousTicketsCorrespondant=$this->getDoctrine()->getRepository(Ticket::class)->trouverTousTicketsCorrespondant($tabCriticite,$tabStatut,$tousLesClients,$tabType,$tabAnneeFinal);
        $session = $request->getSession();
        $session->set('tableauTicket', $tousTicketsCorrespondant);


        //On renvoie à chaque fois le formulaire et un array contenant tous les tickets dans la page
        return $this->render('default/softnlabs_statistique_part.html.twig', array('tickets'=>$tousTicketsCorrespondant,
            'mon_formulaire' => $formView)  );
    }
}