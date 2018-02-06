<?php

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketViewSNLLocked extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('titre',TextType::class, array('disabled'=>true))
            ->add('description',TextType::class, array('disabled'=>true))
            //->add('tpsprisecompte')
            //->add('tpsresolution')
            ->add('idcategorie',  EntityType::class, array(
                'class'=>'AppBundle\Entity\Categorie',
                'choice_label'=> 'getNom',
                'expanded'=> false,
                'multiple'=> false,
                'disabled'=>true
            ))
            ->add('idstatut',  EntityType::class, array(
                'class'=>'AppBundle\Entity\Statut',
                'choice_label'=> 'getDefinition',
                'expanded'=> false,
                'multiple'=> false,
                'disabled'=> true
            ))
            ->add('idcriticite',  EntityType::class, array(
                'class'=>'AppBundle\Entity\Criticite',
                'choice_label'=> 'getChaine',
                'expanded'=> false,
                'multiple'=> false,
                'disabled'=>true
            ))
            ->add('idutilClient',  EntityType::class, array(
                'class'=>'AppBundle\Entity\Utilisateur',
                'choice_label'=> 'getNomAndPrenom',
                'expanded'=> false,
                'multiple'=> false,
                'disabled'=>true
            ))
            ->add('idutilConsultant',  EntityType::class, array(
                'class'=>'AppBundle\Entity\Utilisateur',
                'choice_label'=> 'getNomAndPrenom',
                'expanded'=> false,
                'multiple'=> false,
                'disabled'=> true
            ))
            ->add('idsysteme',  EntityType::class, array(
                'class'=>'AppBundle\Entity\Systeme',
                'choice_label'=> 'getNom',
                'expanded'=> false,
                'multiple'=> false,
                'disabled'=>true
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ticket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ticket';
    }


}
