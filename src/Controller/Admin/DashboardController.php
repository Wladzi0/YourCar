<?php

namespace App\Controller\Admin;

use App\Entity\Engine;
use App\Entity\Make;
use App\Entity\Model;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/welcome.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('YourCar');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoCrud('Users','fa fa-user', User::class);
        yield MenuItem::linktoCrud('Makes','fas fa-car', Make::class);
        yield MenuItem::linktoCrud('Models','fa fa-make', Model::class);
        yield MenuItem::linktoCrud('Engines','fa fa-cogs', Engine::class);
    }
}
