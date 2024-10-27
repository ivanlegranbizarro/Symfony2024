<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile/{user}', name: 'app_profile')]
    public function show(User $user): Response
    {
        $userProfile = $user->getUserProfile();
        $userMicroPosts = $user->getMicroPosts();
        return $this->render('profile/show.html.twig', [
            'user' => $user,
            'userProfile' => $userProfile,
            'userMicroPosts' => $userMicroPosts
        ]);
    }
}
