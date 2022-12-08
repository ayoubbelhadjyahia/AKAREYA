<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('password',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('name',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('role',ChoiceType::class, array('choices'=>['Client'=>1,'Agent Décoration'=>2,'Agent Immobilier'=>3,'Agent Déménagement'=>4],'required' => true, 'attr' => array('class' => 'form-control')))
            ->add('phonenumber',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('cin',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('email',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('photo',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('captcha',ReCaptchaType::class, array('required' => true))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
