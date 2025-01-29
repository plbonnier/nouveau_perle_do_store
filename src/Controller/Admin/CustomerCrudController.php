<?php

namespace App\Controller\Admin;

use App\Entity\Customer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class CustomerCrudController extends AbstractCrudController
{
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }
    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('client')
            ->setEntityLabelInPlural('clients')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un nouveau %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du %entity_label_singular%')
            ->setDefaultSort(['id' => 'ASC']);
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
            ChoiceField::new('civility')
                ->setChoices([
                    'Madame' => 'Madame',
                    'Monsieur' => 'Monsieur',
                    'Monsieur et Madame' => 'Monsieur et Madame',
                    'Société' => 'Société',
                ]),
            TextField::new('lastname'),
            TextField::new('firstname'),
            TextField::new('adress'),
            NumberField::new('zipcode'),
            TextField::new('city'),
            TelephoneField::new('phone'),
            EmailField::new('email'),
            TextEditorField::new('description'),
            NumberField::new('type.discount', 'Remise de base'),
            AssociationField::new('type', 'type de client')
            ->setCrudController(TypeCustomerCrudController::class),
            AssociationField::new('invoices', 'Nombre de factures')
            ->setCrudController(InvoiceCrudController::class)
            ->onlyOnDetail(),
            AssociationField::new('invoices', 'Liste des factures')
                ->formatValue(function ($value, $entity) {
                    return implode(', ', $entity->getInvoices()->map(function ($invoice) {
                        $url = $this->adminUrlGenerator
                            ->setController(InvoiceCrudController::class)
                            ->setAction('detail')
                            ->setEntityId($invoice->getId())
                            ->generateUrl();
                        return sprintf('<a href="%s">%d</a>', $url, $invoice->getNumInvoice());
                    })->toArray());
                })
                ->onlyOnDetail(),
        ];
    }

}
