<?php

namespace App\Controller;

use App\Entity\Rating;
use App\Repository\CarDetailsRepository;
use App\Repository\EngineRepository;
use App\Repository\RatingRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class RatingController extends AbstractController
{
    private $sum = 0;
    private $engine;
    private $car;
    private $userRated = true;
    private $count;


    /**
     * @Route("/rating", name="add_rating")
     * @IsGranted("ROLE_USER", message="You need to login", statusCode=404)
     */
    public function add(
        Request $request,
        CarDetailsRepository $carDetailsRepository,
        EngineRepository $engineRepository,
        RatingRepository $ratingRepository
    ): JsonResponse
    {
        $ratingNum = $request->get('ratingNum');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $isEngine = $request->get('isEngine');

        if ($isEngine === "true") {
            $this->engine = $engineRepository->findOneBy([
                'id' => $request->get('searchObj')
            ]);
            $wasRated = $ratingRepository->findOneBy([
                'engine' => $this->engine,
                'user' => $user
            ]);
        } else {
            $this->car = $carDetailsRepository->findOneBy([
                'id' => $request->get('searchObj')
            ]);
            $wasRated = $ratingRepository->findOneBy([
                'carDetails' => $this->car,
                'user' => $user

            ]);
        }///////

        $em = $this->getDoctrine()->getManager();
        if ($wasRated) {
            $wasRated->setRating($ratingNum);
            $em->persist($wasRated);
        } else {
            $rating = new Rating();
            $rating->setRating($ratingNum);
            if ($isEngine === "true") {
                $rating->setEngine($this->engine);
                $this->count=count($this->engine->getRatings())+1;
            } else {
                $rating->setCarDetails($this->car);
                $this->count=count($this->car->getRatings())+1;
            }

            $rating->setUser($user);
            $em->persist($rating);
            $this->userRated = false;
        }
        $em->flush();

        $response = [
            'count' => $this->count,
            'user' => $this->userRated,
            'rating' => $ratingNum
        ];

        return $this->json($response);
    }


    public function averageRating($obj, $engine): array
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($engine === true) {
            $ratings = $em->getRepository(Rating::class)->findBy([
                'engine' => $obj
            ]);
            $userRated = $em->getRepository(Rating::class)->findOneBy([
                'engine' => $obj,
                'user' => $user
            ]);
        } else {
            $ratings = $em->getRepository(Rating::class)->findBy([
                'carDetails' => $obj
            ]);
            $userRated = $em->getRepository(Rating::class)->findOneBy([
                'carDetails' => $obj,
                'user' => $user,
            ]);
        }
        if (count($ratings) === 0) {
            $result = [
                'rating' => 0,
                'count' => 0,
                'userRated' => null
            ];
        } else {
            foreach ($ratings as $rating) {
                $this->sum += $rating->getRating();
            }
            $result = [
                'rating'=> $this->sum / count($ratings),
                'count' => count($ratings),
                'userRated' => $userRated
                ];

        }

        return $result;
    }
}
