<?php

namespace App\Controller;

use App\Entity\CarDetails;
use App\Entity\Favourite;
use App\Repository\FavouriteRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @IsGranted("ROLE_USER")
 */
class FavouriteController extends AbstractController
{

    /**
     * @Route("/cars/favourite/list", name="favourite_cars_list")
     */
    public function list(FavouriteRepository $favouriteRepository): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $bests = $favouriteRepository->findBy([
            'user' => $user
        ]);
        return $this->render('car/favourite/list.html.twig', [
            'bests' => $bests
        ]);
    }

    /**
     * @Route("/car/{id}/favourite", name="favourite")
     */
    public function add(FavouriteRepository $favouriteRepository, CarDetails $car): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (!$user) {
            return $this->json([
                'code' => 403,
                'message' => 'Unauthorized'
            ], 403);
        }
        $em = $this->getDoctrine()->getManager();
        if ($car->isFavouredByUser($user)) {
            $favoured = $favouriteRepository->findOneBy([
                'user' => $user,
                'carDetails' => $car
            ]);

            $em->remove($favoured);
            $em->flush();

            return $this->json([
                'code' => 200,
                'message' => 'car was deleted',
            ]);
        } else {
            $favourite = new Favourite();
            $favourite->setCarDetails($car);
            $favourite->setUser($user);
            $em->persist($favourite);
            $em->flush();

            return $this->json([
                'code' => 201,
                'message' => 'car was added to favourite'
            ]);
        }
    }


}
