<?php

namespace App\Form;

use App\Entity\Agency;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class AgencyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('password',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('name',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('type',ChoiceType::class, array('choices'=>['Agence Immobilière '=>1,'Agence Décoration'=>2,'Agence Déménagement'=>3,'Agence Construction'=>4],'required' => true, 'attr' => array('class' => 'form-control')))
            ->add('matriculation',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('email',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('phonenumber',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('location',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('photo',TextType::class, array('required' => true, 'attr' => array('class' => 'form-control')))
            ->add('user',EntityType::class,['class'=>User::class,'choice_label'=>'username','multiple'=>false,'expanded'=>false,'required'=> true , 'attr' => array('class' => 'form-control') ])
            ->add('captcha',ReCaptchaType::class, array('required' => true))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agency::class,
        ]);
    }
}
