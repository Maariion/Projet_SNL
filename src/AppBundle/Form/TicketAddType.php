<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketAddType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class)
            ->add('description',TextType::class)
            //->add('tpsprisecompte')
            //->add('tpsresolution')
            ->add('idtyp',  EntityType::class, array(
                'class'=>'AppBundle\Entity\Type',
                'choice_label'=> 'getNom',
                'expanded'=> false,
                'multiple'=> false
            ))
            ->add('idcrit', EntityType::class, array(
                'class'=>'AppBundle\Entity\Criticite',
                'choice_label'=> 'getChaine',
                'expanded'=> false,
                'multiple'=> false
            ))
            //->add('idutilClient')
            //->add('idutilConsultant')
            ->add('idsys', EntityType::class, array(
                'class'=>'AppBundle\Entity\Systeme',
                'choice_label'=> 'getNomAndVersion',
                'expanded'=> false,
                'multiple'=> false
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
