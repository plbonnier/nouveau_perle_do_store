<?php

namespace App\Controller\Admin;

use App\Entity\TypeCustomer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class TypeCustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeCustomer::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('type de client')
            ->setEntityLabelInPlural('types de client')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un nouveau %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un %entity_label_singular%')
            ->setDefaultSort(['id' => 'ASC']); // Tri par ID dans l'ordre croissant
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::DELETE);
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
