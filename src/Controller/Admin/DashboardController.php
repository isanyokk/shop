<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setLocales([
                'ru' => 'ru',
            ])
            ->setTitle('Shop');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Товары', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Фото товаров', 'fas fa-list', Image::class);
    }
}
