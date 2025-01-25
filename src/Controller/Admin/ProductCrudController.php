<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ProductCrudController extends AbstractCrudController
{
    public function __construct(
        private ProductRepository $productRepository
    ) {}
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('produit')
            ->setEntityLabelInPlural('produits')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un nouveau %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du %entity_label_singular%')
            ->setDefaultSort(['id' => 'ASC']); // Tri par ID dans l'ordre croissant
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('ref')->hideOnForm(),
            TextField::new('name', 'Nom'),
            AssociationField::new('category', 'Catégorie')->autocomplete()
            ->setQueryBuilder(function ($queryBuilder) {
                return $queryBuilder->orderBy('entity.name', 'ASC');
            }),
            AssociationField::new('material', 'Matériaux')->autocomplete()
            ->setQueryBuilder(function ($queryBuilder) {
                return $queryBuilder->orderBy('entity.name', 'ASC');
            }),
            NumberField::new('price', 'Prix de vente'),
            IntegerField::new('quantity', 'Quantité'),
            NumberField::new('purchasePrice', 'Prix d\'achat'),
            BooleanField::new('tva', 'Achat avec tva'),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Product) {
            $newRef = $this->productRepository->getLastRef() + 1;
            $entityInstance->setRef($newRef);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }
}
