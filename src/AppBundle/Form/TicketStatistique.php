<?php

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use AppBundle\Repository\TicketRepository;


class TicketStatistique extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('chaine', EntityType::class, array(
                'class' => 'AppBundle\Entity\Criticite',
                'choice_label' => 'getChaine',
                'expanded' => false,
                'multiple' => true
            ))
            ->add('definition', EntityType::class, array(
                'class' => 'AppBundle\Entity\Statut',
                'choice_label' => 'getDefinition',
                'expanded' => false,
                'multiple' => true
            ))
            ->add('nom', EntityType::class, array(
                'class' => 'AppBundle\Entity\Organisation',
                'choice_label' => 'getNom',
                'expanded' => false,
                'multiple' => true
            ))
            ->add('categorie', EntityType::class, array(
                'class' => 'AppBundle\Entity\Categorie',
                'choice_label' => 'getNom',
                'expanded' => false,
                'multiple' => true
            ))
            ->add('annee', ChoiceType::class, array(
                'choices' => $options['annee'],
                'expanded' => false,
                'multiple' => true
            ));
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ticketStat';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('annee');
    }


}
