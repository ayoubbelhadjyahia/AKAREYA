<?php

namespace App\Form;

use App\Entity\MissionDeco;
use App\Entity\OutilDeco;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionDecoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intituler_mission_deco',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control'))
            )
            ->add('date_debut_mission',DateType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('date_fin_mission',DateType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('localisation_mission',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('id_outil_deco',EntityType::class,['class'=>OutilDeco::class,'choice_label'=>'type_outil_d','multiple'=>false,'required'=>false,'required' => true, 'attr' => array('class' => 'form-control')])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MissionDeco::class,
        ]);
    }
}
