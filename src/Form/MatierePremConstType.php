<?php

namespace App\Form;

use App\Entity\MatierePremConst;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MatierePremConstType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_matiere_const',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
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
            'data_class' => MatierePremConst::class,
        ]);
    }
}
