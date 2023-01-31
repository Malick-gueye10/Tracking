<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
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
                    'Administrateur'    =>  'ROLE_ADMIN',
                    'Client' =>  'ROLE_CLIENT'
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
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => 'Mot de Passe',
                'attr' => ['autocomplete' => 'new-password',
                            'class'       =>  'form-control'
                        ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre Mot de passe SVP',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('adresse',  TextType::class, [
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
