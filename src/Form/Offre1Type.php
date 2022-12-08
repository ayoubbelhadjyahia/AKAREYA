<?php

namespace App\Form;

use App\Entity\Offre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
class Offre1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_bien_offre',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('detailsrdv',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('prix_offre',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('superficie_offre',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('categorie_offre',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('adresse_offre',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de loffre ( des images uniquement)',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
