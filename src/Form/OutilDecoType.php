<?php

namespace App\Form;

use App\Entity\OutilDeco;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class OutilDecoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_outil_d',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('Date_mise_Service',DateType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('prix_outil',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
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
            'data_class' => OutilDeco::class,
        ]);
    }
}
