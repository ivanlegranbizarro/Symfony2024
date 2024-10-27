<?php

namespace App\Controller;

use App\Entity\MicroPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class LikeController extends AbstractController
{
    #[Route('/like/{micropost}', name: 'like')]
    public function like(MicroPost $micropost, #[CurrentUser] $user, EntityManagerInterface $entityManager, Request $request): Response
    {
        $micropost->addLikedBy($user);
        $entityManager->flush();

        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/unlike/{micropost}', name: 'unlike')]
    public function unlike(MicroPost $micropost, #[CurrentUser] $user, EntityManagerInterface $entityManager, Request $request): Response
    {
        $micropost->removeLikedBy($user);
        $entityManager->flush();

        return $this->redirect($request->headers->get('referer'));
    }
}
