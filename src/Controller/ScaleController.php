<?php

namespace App\Controller;

use App\Entity\CarDetails;
use App\Entity\Scale;
use App\Repository\ScaleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class ScaleController extends AbstractController
{
    /**
     * @Route("/cars/comparing", name="comparing_list")
     */
    public function list(ScaleRepository $scaleRepository): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $compareCars = $scaleRepository->findBy([
            'user' => $user
        ]);
        return $this->render('comparing/list.html.twig', [
            'cars' => $compareCars
        ]);
    }

    /**
     * @Route("/car/{id}/comparing", name="comparing")
     */
    public function comparing(
        CarDetails $car,
        ScaleRepository $scaleRepository
    ): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($car->isScaledByUser($user)) {
            $scaled = $scaleRepository->findOneBy([
                'user' => $user,
                'carDetails' => $car
            ]);
            $em->remove($scaled);
            $em->flush();

            return $this->json([
                'code' => 200,
                'message' => 'was deleted from scale successfully'
            ]);
        } else {
            $scale = new Scale();
            $scale->setUser($user);
            $scale->setCarDetails($car);
            $em->persist($scale);
            $em->flush();

            return $this->json([
                'code' => 201,
                'message' => "success add to scale"
            ]);
        }
    }
}
