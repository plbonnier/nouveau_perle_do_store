<?php

namespace App\Controller\Admin;

use App\Entity\InvoiceProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;


class InvoiceProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InvoiceProduct::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('produit dans la facture')
            ->setEntityLabelInPlural('produits dans les factures')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un nouveau %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du %entity_label_singular%')
            ->setDefaultSort(['id' => 'DESC']);
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
            AssociationField::new('invoice', 'Numéro de facture')
                ->setCrudController(InvoiceCrudController::class)
                ->setFormTypeOption('choice_label', 'numInvoice'),
            AssociationField::new('product', 'nom du produit')
                ->setCrudController(ProductCrudController::class)
                ->setFormTypeOption('choice_label', 'label'),
            NumberField::new('product.price', 'prix du produit')
                ->onlyOnIndex()
                ->onlyOnDetail(),
            NumberField::new('quantity', 'Quantité'),
        ];
    }
}
