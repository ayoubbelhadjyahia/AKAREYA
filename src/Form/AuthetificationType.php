<?php

namespace App\Form;

use App\Entity\Agency;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AuthetificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control'),'constraints' => [new NotBlank(message: 'Username manquant !') ]))
            ->add('password',PasswordType::class, array('required' => true, 'attr' => array('class' => 'form-control'),'constraints' => [new NotBlank(message: 'Password manquant !') ]))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            //'data_class' => Agency::class,
        ]);
    }
}