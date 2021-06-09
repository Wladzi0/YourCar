<?php

namespace App\Controller;

use App\Entity\CarDetails;
use App\Entity\Scale;
use App\Repository\ScaleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @IsGranted("ROLE_USER")
 */
class ScaleController extends AbstractController
{
    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getToken()->getUser();
    }

    /**
     * @Route("/cars/comparing", name="comparing_list")
     */
    public function list(ScaleRepository $scaleRepository): Response
    {
        $compareCars = $scaleRepository->findBy([
            'user' => $this->user
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
        $em = $this->getDoctrine()->getManager();
        if ($car->isScaledByUser($this->user)) {
            $scaled = $scaleRepository->findOneBy([
                'user' => $this->user,
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
            $scale->setUser($this->user);
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
