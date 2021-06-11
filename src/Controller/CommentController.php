<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\EngineRepository;
use App\Repository\FaultRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class CommentController extends AbstractController
{
    private $result;
    private $engine;
    private $fault;
    /**
     * @Route("/comment/add", name="add_comment")
     */
    public function add(
        Request $request,
        FaultRepository $faultRepository,
        EngineRepository $engineRepository
    ): Response
    {
        $newComment = $request->get('comment');
        $isFault = $request->get('isFault');
        $objId = $request->get('id');
        if ($newComment) {
            $comment = new Comment();
            $comment->setContent($newComment);
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $comment->setUser($user);
            if ($isFault === "true") {
                $this->fault = $faultRepository->findOneBy([
                    'id' => $objId
                ]);
                $comment->setFault($this->fault);
            } else {
                $this->engine = $engineRepository->findOneBy([
                    'id' => $objId
                ]);
                $comment->setEngine($this->engine);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            if ($isFault === "true") {
                $count = $this->fault->getComments()->count();
            } else {
                $count = $this->engine->getComments()->count();
            }
            $this->result['comment'] = [
                $count,
                $comment->getUser()->getFirstName(),
                $comment->getUser()->getLastName(),
                $comment->getCreatedAt()->format('Y-m-d'),
                $comment->getContent()
            ];
        }
        return new Response(json_encode($this->result));
    }
}
