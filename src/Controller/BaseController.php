<?php

namespace App\Controller;

use App\Entity\Engine;
use App\Entity\Fault;
use App\Entity\Image;
use App\Entity\SubModel;
use App\Form\FaultFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route ("/fault/add", name="fault_add")
     * @IsGranted ("ROLE_USER")
     */
    public function userDefinedFault(Request $request, Session $session): Response
    {
        $engineId = $request->get('engine');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $fault = new Fault();
        $faultForm = $this->createForm(FaultFormType::class, $fault);
        $faultForm->handleRequest($request);

        if ($faultForm->isSubmitted() && $faultForm->isValid()) {
            $fault->setUser($user);
            $images = $faultForm->get('images')->getData();
            foreach ($images as $image) {
                $file = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('fault_images_directory'),
                    $file
                );
                $img= new Image();
                $img->setImage($file);
                $fault->addImage($img);

            }

            $em = $this->getDoctrine()->getManager();
            if ($engineId) {
                $engine = $em->getRepository(Engine::class)->findOneBy([
                    'id' => $engineId
                ]);
                $fault->addEngine($engine);


            } else {
                $subModel = $em->getRepository(SubModel::class)->findOneBy([
                    'id' => $request->get('subModel')
                ]);
                $fault->addSubModel($subModel);
            }
            $em->persist($fault);
            $em->flush();
            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Your request has been added successfully to queue');
            $sessionUrl = $request->getSession()->get('url');

            $session->clear();
            if ($sessionUrl) {
                return new RedirectResponse($sessionUrl);
            }
        }

        return $this->render('car/catalog/fault/fault_form.html.twig', [
            'faultForm' => $faultForm->createView(),
        ]);

    }

    /**
     * @Route ("/session/add", name="add_session")
     * @IsGranted ("ROLE_USER")
     */
    public function addToSession(Request $request, Session $session): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $session->set('url', $request->get('url'));

        return $this->json('success');
    }
}
