<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Customer;
use App\Entity\Invoice;
use App\Entity\InvoiceProduct;
use App\Entity\Material;
use App\Entity\Product;
use App\Entity\TypeCustomer;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use function Symfony\Component\String\s;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
    

    $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
    return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('PERLE DO')
            ->setFaviconPath('\build\images\main.623ca7c1.svg');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('retour au site', 'fa fa-circle-left', 'app_category_index');
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Liste des utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Liste des catégories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Liste des matériaux', 'fas fa-list', Material::class);
        yield MenuItem::linkToCrud('Liste des produits', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Liste des factures', 'fas fa-list', Invoice::class);
        yield MenuItem::linkToCrud('Liste des produits dans facture', 'fas fa-list', InvoiceProduct::class);
        yield MenuItem::linkToCrud('Liste des clients', 'fas fa-male fa-female', Customer::class);
        yield MenuItem::linkToCrud('Liste des type de clients', 'fas fa-list', TypeCustomer::class);
    }
}
