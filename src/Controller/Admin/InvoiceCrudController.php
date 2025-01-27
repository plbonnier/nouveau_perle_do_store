<?php

namespace App\Controller\Admin;

use App\Entity\Invoice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class InvoiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Invoice::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('facture')
            ->setEntityLabelInPlural('factures')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un nouveau %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un %entity_label_singular%')
            ->setDefaultSort(['numInvoice' => 'DESC']); // Tri par ID dans l'ordre croissant
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
            NumberField::new('numInvoice', 'Numéro de la facture')
            ->hideOnForm(),
            DateTimeField::new('date', 'Date de la facture'),
            NumberField::new('total', 'Total de la facture'),
            NumberField::new('discount', 'Remise'),
            ChoiceField::new('payementType', 'Type de paiement')
            ->setChoices([
                'carte bancaire' => 'carte bancaire',
                'espèce' => 'espèce',
                'virement' => 'virement',
                'chèque' => 'chèque',
            ])
            ->renderExpanded(),
        ];
    }
}
