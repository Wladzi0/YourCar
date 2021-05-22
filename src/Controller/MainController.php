<?php

namespace App\Controller;

use App\Repository\MakeRepository;
use App\Repository\ModelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [

        ]);
    }

    /**
     * @Route("/makes/list", name="makes_list")
     */
    public function makesList(MakeRepository $makeRepository): Response
    {
        $makes=$makeRepository->findAll();
        return $this->render('car/catalog/make/list.html.twig', [
        'makes'=>$makes
        ]);
    }

    /**
     * @Route("/make/{make}/models/list", name="models_list")
     */
    public function modelsList(Request $request,ModelRepository $modelRepository): Response
    {
        $make=$request->get('make');
        $models=$modelRepository->findby(['make'=>$make]);
        return $this->render('car/catalog/model/list.html.twig', [
            'models'=>$models,
            'make'=>$make
        ]);
    }

    /**
     * @Route("/make/{make}/model/{model}", name="model_details")
     */
    public function modelDetails(Request $request,ModelRepository $modelRepository, MakeRepository $makeRepository): Response
    {
        $make=$makeRepository->find($request->get('make'));
        $model=$modelRepository->find($request->get('model'));
        return $this->render('car/catalog/model/details.html.twig', [
            'model'=> $model,
            'make' => $make
        ]);
    }

}
