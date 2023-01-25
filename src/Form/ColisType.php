<?php

namespace App\Form;

use App\Entity\LTA;
use App\Entity\Colis;
use App\Entity\User;
use App\Repository\LTARepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ColisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('numColis', TextType::class, [
            'label' =>  'Numéro Colis (*)',
            'required'  =>  true,
            'attr'      =>  [
                'class' =>  'form-control'
            ]
        ])
        
        ->add('lta', EntityType::class, [
            'placeholder'   =>  'Sélectionner ---',
            'label' =>  'LTA(*)',
            'attr'  =>  [
                'class'             =>  'form-control'
            ],
            'class'         => LTA::class,
            'choice_label'  => 'numLTA',
            
        ])

        ->add('user', EntityType::class, [
            'placeholder'   =>  'Sélectionner ---',
            'label' =>  'Client(*)',
            'attr'  =>  [
                'class'             =>  'form-control'
            ],
            'class'         => User::class,
            'choice_label'  => 'email',
            
        ])

        ->add('description', TextareaType::class, [
            'label'     =>  'Description',
            'required'  =>  false,
            'attr'      => [
                'class' =>  'form-control'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Colis::class,
        ]);
    }
}
