<?php

namespace App\Form;

use App\Entity\Dossiers;
use App\Entity\Produits;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DossiersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_commande')
            ->add('nombre')
            ->add('id_client')
            ->add('produit',EntityType::class,[
                'class'=>Produits::class,'choice_label'=>'type_produit','label'=>'type_de_produit'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dossiers::class,
        ]);
    }
}
