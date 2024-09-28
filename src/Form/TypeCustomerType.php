<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'particulier' => 'particulier',
                    'commerçant' => 'commerçant',
                    'police' => 'police',
                    'pompier' => 'pompier',
                    'famille' => 'famille',
                    'ami' => 'ami',
                    'carte de fidélité' => 'carte de fidélité',
                    'professionnel' => 'professionnel',
                ],
                'placeholder' => 'Choisir un type de client',
                'label' => 'Type de client',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
