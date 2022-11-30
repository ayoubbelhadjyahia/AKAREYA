<?php

namespace App\Form;

use App\Entity\DossierConst;
use App\Entity\MatierePremConst;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DossierConstType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('duree_location_dossier_const',DateType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('id_terrain_const',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('user_id',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('id_matiere_const',EntityType::class,['class'=>MatierePremConst::class,'choice_label'=>'type_matiere_const','multiple'=>false,'expanded'=>false,'required' => true, 'attr' => array('class' => 'form-control')]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DossierConst::class,
        ]);
    }
}
