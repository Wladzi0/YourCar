<?php

namespace App\Controller\Admin;

use App\Entity\CarDetails;
use App\Entity\Engine;
use App\Entity\Fault;
use App\Entity\Make;
use App\Entity\Model;
use App\Entity\Rim;
use App\Entity\SubModel;
use App\Entity\Tire;
use App\Entity\Transmission;
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
        yield MenuItem::section('User settings');
        yield MenuItem::linktoCrud('Users','fa fa-user', User::class);
        yield MenuItem::section('Car');
        yield MenuItem::linktoCrud('Makes','fas fa-list-ul', Make::class);
        yield MenuItem::linktoCrud('Models','fa fa-make', Model::class);
        yield MenuItem::linktoCrud('SubModels','fa fa-car', SubModel::class);
        yield MenuItem::linktoCrud('Engines','fa fa-cog', Engine::class);
        yield MenuItem::linktoCrud('Car Details','fas fa-puzzle-piece', CarDetails::class);
        yield MenuItem::linktoCrud('Rims','fab fa-empire', Rim::class);
        yield MenuItem::linktoCrud('Tires','fa fa-life-ring', Tire::class);
        yield MenuItem::linktoCrud('Faults','fas fa-exclamation', Fault::class);
        yield MenuItem::linktoCrud('Transmissions','fa fa-cogs', Transmission::class);
    }
}
