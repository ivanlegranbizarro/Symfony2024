<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/micropost', name: 'micropost_')]
class MicroPostController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(MicroPostRepository $repository): Response
    {
        $microposts = $repository->findAll();
        return $this->render('micro_post/index.html.twig', [
            'microposts' => $microposts,
        ]);
    }

    #[Route('/{micropost}', name: 'show', methods: ['GET'])]
    public function show(MicroPost $micropost): Response
    {
        return $this->render('micro_post/show.html.twig', [
            'micropost' => $micropost,
        ]);
    }
}
