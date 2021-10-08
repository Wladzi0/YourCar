<?php

namespace App\Controller;

use App\Form\UserSettingsFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PreferenceController extends AbstractController
{
    /**
     * @Route("/user/preferences", name="userPreferences")
     */
    public function settings(Request $request): Response
    {
        $user = $this->get('security.token_storage')
            ->getToken()->getUser();
        $settingsForm = $this->createForm(UserSettingsFormType::class, $user);
        $settingsForm->handleRequest($request);

        if ($settingsForm->isSubmitted() && $settingsForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            return new Response(json_encode(['status' => 'success']));
        }
        return $this->render('preference/settings.html.twig', [
            'settingsForm' => $settingsForm->createView()
        ]);
    }

    /**
     * @Route("/user/preferences/reset", name="resetPreferences")
     */
    public function deleteSettings(Request $request, UserRepository $userRepo): Response
    {
        $user = $this->get('security.token_storage')
            ->getToken()->getUser();
        $userData = $userRepo->find($user);
        $userData->setPreferLanguage('en');
        $userData->setCarType(null);
        $userData->setTuning(null);
        $userData->setFuelConsumption(null);
        $this->getDoctrine()->getManager()->flush();

        return  $this->json([
            'code'=>200,
            'message'=> 'settings have been reset'],
            200);

    }

}
