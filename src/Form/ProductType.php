<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Material;
use App\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'Catégorie du produit',
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC'); // Tri par ordre alphabétique (ASC)
                },
                'placeholder' => 'Choisir une catégorie',
            ])
            ->add('material', EntityType::class, [
                'class' => Material::class,
                'label' => 'Matériau du produit',
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC'); // Tri par ordre alphabétique (ASC)
                },
                'placeholder' => 'Choisir un matériau',
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom du produit',
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix du produit',
                // 'html5' => true,
                'attr' => [
                    'step' => 0.01,
                    'min' => 0.01,
                ],
            ])
            ->add('quantity', NumberType::class, [
                'label' => 'Quantité en stock',
                'attr' => [
                    'step' => 1,
                    'min' => 0,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
