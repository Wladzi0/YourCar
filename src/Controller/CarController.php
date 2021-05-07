<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    /**
     * @Route("/car", name="car")
     */
    public function index(): Response
    {
        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/best/cars/list", name="best_cars_list")
     */
    public function bestCar(): Response
    {
        return $this->render('car/best/index.html.twig', [
            'controller_name' => 'CarController',
        ]);
    }
}
