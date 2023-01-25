<?php

namespace App\Form;

use App\Entity\LTA;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class LTAType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numLTA', TextType::class, [
                'label' =>  'LTA (*)',
                'required'  =>  true,
                'attr'      =>  [
                    'class' =>  'form-control'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label'     =>  'Description',
                'required'  =>  false,
                'attr'      => [
                    'class' =>  'form-control'
                ]
            ])
            ->add('dateDepart', DateType::class, [
                'label' =>  'Date de départ',
                'required'  =>  true,
                'attr'      =>  [
                    'class' =>  'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LTA::class,
        ]);
    }
}
