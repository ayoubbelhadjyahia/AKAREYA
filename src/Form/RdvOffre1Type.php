<?php

namespace App\Form;

use App\Entity\Offre;
use App\Entity\RdvOffre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RdvOffre1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_heure_rdv_offre')

            ->add('user_id')
            ->add('offre',EntityType:: class , ['class'=>Offre::class,'choice_label'=>'detailsrdv'
            ,'label'=>'type de loffre'])


              ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RdvOffre::class,
        ]);
    }
}
