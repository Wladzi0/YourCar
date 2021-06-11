<?php

namespace App\Controller;

use App\Entity\CarDetails;
use App\Entity\Engine;
use App\Entity\Make;
use App\Entity\Model;
use App\Entity\SubModel;
use App\Repository\CarDetailsRepository;
use App\Repository\EngineRepository;
use App\Repository\FaultRepository;
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
        $models = $modelRepository->findby([
            'make' => $make
        ]);
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

        if ($dataRequest['carDetails'][0] == true) {
            $carDetails = $this->getDoctrine()
                ->getRepository(CarDetails::class)
                ->findBy([
                    'subModel' => $dataRequest['subModel'],
                    'engine' => $dataRequest['carDetails']
                ]);
        } elseif ($dataRequest['carDetails'][0] == false) {
            $carDetails = $this->getDoctrine()
                ->getRepository(CarDetails::class)
                ->findBy([
                    'subModel' => $dataRequest['subModel']]);
        } else {
            $carDetails = null;
        }
        return [
            'make' => $make,
            'model' => $model,
            'subModel' => $subModel,
            'carDetails' => $carDetails
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
            'subModel' => null,
            'carDetails' => [null, null]
        ];
        $foundedData[] = $this->searchByLink($dataRequest);
        return $this->render('car/catalog/model/details.html.twig', [
            'make' => $foundedData[0]['make'],
            'model' => $foundedData[0]['model']
        ]);
    }


    /**
     * @Route("/make/{make}/model/{model}/submodel/{subModel}",
     *     name="sub_model_details"
     * )
     */
    public function subModelDetails(Request $request): Response
    {
        $subModel = $request->get('subModel');
        $dataRequest = [
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'subModel' => $subModel,
            'carDetails' => [false, null]

        ];
        $foundedData[] = $this->searchByLink($dataRequest);
        return $this->render('car/catalog/subModel/details.html.twig', [
            'make' => $foundedData[0]['make'],
            'model' => $foundedData[0]['model'],
            'subModel' => $foundedData[0]['subModel'],
            'engines' => $foundedData[0]['carDetails']
        ]);
    }

    /**
     * @Route("/make/{make}/model/{model}/submodel/{subModel}/engine/{engine}/details",
     *      name="details_by_engine"
     * )
     */
    public function DetailsByEngine(Request $request): Response
    {
        $dataRequest = [
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'subModel' => $request->get('subModel'),
            'carDetails' => [true, $request->get('engine')],
        ];
        $foundedData[] = $this->searchByLink($dataRequest);
        return $this->render('car/catalog/subModel/details_by_engine.html.twig', [
            'make' => $foundedData[0]['make'],
            'model' => $foundedData[0]['model'],
            'subModel' => $foundedData[0]['subModel'],
            'carDetails' => $foundedData[0]['carDetails']
        ]);
    }

    /**
     * @Route ("/make/{make}/model/{model}/submodel/{subModel}/fault/{fault}",
     *      name="subModel_fault"
     * )
     */
    public function SubModelFault(
        Request $request,
        FaultRepository $faultRepository,
        MakeRepository $makeRepository
    ): Response
    {
        $make = $makeRepository->find($request->get('make'));
        $fault = $faultRepository->find($request->get('fault'));
        return $this->render('car/catalog/fault/details.html.twig', [
            'make' => $make,
            'fault' => $fault,

        ]);
    }

    /**
     * @Route ("/engine/{id}", name="engine_details")
     */
    public function engineDetails(Request $request, Engine $engine): Response
    {
        return $this->render('car/catalog/engine/details.html.twig', [
            'engine' => $engine,

        ]);
    }


}
