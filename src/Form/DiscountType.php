<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('discount', ChoiceType::class, [
                'choices' => [
                    'Pas de réduction' => 0,
                    '5%' => 0.05,
                    '10%' => 0.10,
                    '20%' => 0.20,
                ],
                'label' => 'Réduction',
            ])
            ->add('apply', SubmitType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'fa-solid fa-check no-button',
                    // Assurez-vous que 'aria-hidden' n'est pas ajouté
                ],
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }
}
