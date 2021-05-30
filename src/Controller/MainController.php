<?php

namespace App\Controller;

use App\Entity\Make;
use App\Entity\Model;
use App\Entity\SubModel;
use App\Repository\CarDetailsRepository;
use App\Repository\EngineRepository;
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
        $makes = $makeRepository->findAll();
        return $this->render('car/catalog/make/list.html.twig', [
            'makes' => $makes
        ]);
    }

    /**
     * @Route("/make/{make}/models/list", name="models_list")
     */
    public function modelsList(Request $request, ModelRepository $modelRepository): Response
    {
        $make = $request->get('make');
        $models = $modelRepository->findby(['make' => $make]);
        return $this->render('car/catalog/model/list.html.twig', [
            'models' => $models,
            'make' => $make
        ]);
    }

    public function searchByLink($dataRequest): array
    {
        $make = $this->getDoctrine()
            ->getRepository(Make::class)
            ->find($dataRequest['make']);
        $model = $this->getDoctrine()
            ->getRepository(Model::class)
            ->find($dataRequest['model']);
        if ($dataRequest['subModel']) {
            $subModel = $this->getDoctrine()
                ->getRepository(SubModel::class)
                ->find($dataRequest['subModel']);
        } else {
            $subModel = null;
        }
        return [
            'make' => $make,
            'model' => $model,
            'subModel' => $subModel
        ];
    }

    /**
     * @Route("/make/{make}/model/{model}", name="model_details")
     */
    public function modelDetails(Request $request): Response
    {
        $dataRequest = [
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'subModel' => null
        ];
        $foundedData[] = $this->searchByLink($dataRequest);
        return $this->render('car/catalog/model/details.html.twig', [
            'make' => $foundedData[0]['make'],
            'model' => $foundedData[0]['model']
        ]);
    }


    /**
     * @Route("/make/{make}/model/{model}/submodel/{subModel}", name="sub_model_details")
     */
    public function subModelDetails(Request $request): Response
    {
        $dataRequest = [
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'subModel' => $request->get('subModel'),
        ];
        $foundedData[] = $this->searchByLink($dataRequest);
        return $this->render('car/catalog/subModel/details.html.twig', [
            'make' => $foundedData[0]['make'],
            'model' => $foundedData[0]['model'],
            'subModel' => $foundedData[0]['subModel']
        ]);
    }

    /**
     * @Route("/make/{make}/model/{model}/submodel/{subModel}/engine/{engine}", name="engine_details")
     */
    public function engineDetails(Request $request, EngineRepository $engineRepository, CarDetailsRepository $carDetailsRepository): Response
    {
        $make=$request->get('make');
        $dataRequest = [
            'make' => $make,
            'model' => $request->get('model'),
            'subModel' => $request->get('subModel'),
        ];
        $foundedData[] = $this->searchByLink($dataRequest);

        $engine = $engineRepository
            ->find(
                $request->get('engine')
            );
        $carDetails = $carDetailsRepository
            ->findBy(
            [
                'subModel' => $make,
            ]);
        return $this->render('car/catalog/engine/details.html.twig', [
            'make' => $foundedData[0]['make'],
            'model' => $foundedData[0]['model'],
            'subModel' => $foundedData[0]['subModel'],
            'engine' => $engine,
            'carDetails' => $carDetails
        ]);
    }

}
