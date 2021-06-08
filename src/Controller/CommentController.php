<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Fault;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
//    /**
//     * @IsGranted("ROLE_USER")
//     * @Route("/check/user", name="check_user")
//     */
//    public function check(): Response
//    {
//        return $this->render('car/favourite/list.html.twig', [
//            'bests' => 'asdf'
//        ]);
//    }

    /**
     * @Route("/fault/{id}/comment/add", name="add_fault_comment")
     */
    public function add(Request $request, Fault $fault): Response
    {
        $newComment= $request->get('comment');
        if($newComment){
            $comment = new Comment();
            $comment->setContent($newComment);
            $user=$this->get('security.token_storage')->getToken()->getUser();
            $comment->setUser($user);
            $comment->setFault($fault);
            $em=$this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $result['comment']=[
                $fault->getComments()->count(),
                $comment->getUser()->getFirstName(),
                $comment->getUser()->getLastName(),
                $comment->getCreatedAt()->format('Y-m-d'),
                $comment->getContent()
            ];
        }
        return new Response(json_encode($result));
    }
}
