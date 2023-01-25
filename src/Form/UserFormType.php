<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' =>  'Email(*)',
                'attr'  =>  [
                    'class'             =>  'form-control'
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'placeholder'   =>  'Sélectionner ---',
                'label' =>  'Profil(*)',
                'attr'  =>  [
                    'class'             =>  'form-control'
                ],
                'choices' => [
                    'Administrateur'            =>  'ROLE_ADMIN',
                    'Client'          =>  'ROLE_CLIENT'
                ],
                'multiple' => true
            ])
            
            ->add('prenom', TextType::class, [
                'label' =>  'Prénom (*)',
                'attr'  =>  [
                    'class'             =>  'form-control'
                ]
            ])
            ->add('nom',  TextType::class, [
                'label' =>  'Nom (*)',
                'attr'  =>  [
                    'class'             =>  'form-control'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' =>  'Mot de Passe',
                'attr'  =>  [
                    'class'             =>  'form-control'
                ]
            ])
            ->add('adresse',  TextareaType::class, [
                'label'     =>  'Adresse',
                'required'  => false,
                'attr'  =>  [
                    'class'             =>  'form-control',
                ]
            ])
            ->add('telephone', TelType::class, [
                'label'     =>  'Téléphone',
                'required'  => false,
                'attr'  =>  [
                    'class'             =>  'form-control',
                    'data-inputmask'    =>  '"mask": "(999) 999-9999"'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
