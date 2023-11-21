<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Entity\Param;
use App\Entity\ParamType;
use App\Entity\Product;
use App\Entity\ProductType;
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
            ->setTitle('Магазин');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Товары', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Типы товаров', 'fas fa-list', ProductType::class);
        yield MenuItem::linkToCrud('Параметры', 'fas fa-list', Param::class);
        yield MenuItem::linkToCrud('Типы параметров', 'fas fa-list', ParamType::class);
    }
}
