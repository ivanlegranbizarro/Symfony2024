<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class FollowerController extends AbstractController
{
    #[Route('/follow/{userToFollow}', name: 'app_follow')]
    public function follow(User $userToFollow, #[CurrentUser] $user, EntityManagerInterface $entityManager, Request $request): Response
    {
        $user->follow($userToFollow);
        $entityManager->flush();

        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/unfollow/{userToUnfollow}', name: 'app_unfollow')]
    public function unfollow(User $userToUnfollow, #[CurrentUser] $user, EntityManagerInterface $entityManager, Request $request): Response
    {
        $user->unfollow($userToUnfollow);
        $entityManager->flush();

        return $this->redirect($request->headers->get('referer'));
    }
}
