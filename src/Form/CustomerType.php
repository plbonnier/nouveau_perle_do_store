<?php

namespace App\Form;

use App\Entity\Customer;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('civility', ChoiceType::class, [
                'choices' => [
                    'Madame' => 'Madame',
                    'Monsieur' => 'Monsieur',
                    'Monsieur et Madame' => 'Monsieur et Madame',
                ],
                'placeholder' => 'Choisir une civilité',
                'label' => 'Civilité',
                'required' => false,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => false,
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adresse',
                'required' => false,
            ])
            ->add('zipcode', NumberType::class, [
                'label' => 'Code postal',
                'required' => false,
                'invalid_message' => 'Le code postal doit être composé uniquement de chiffres',
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'required' => false,
            ])
            ->add('phone', NumberType::class, [
                'label' => 'Téléphone',
                'required' => false,
                'invalid_message' => 'le numéro de téléphone doit être composé uniquement de chiffres',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
