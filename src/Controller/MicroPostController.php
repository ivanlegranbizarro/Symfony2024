<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostFormType;
use App\Repository\MicroPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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


    #[Route('/add', name: 'add', methods: ['GET', 'POST'], priority: 2)]
    public function store(Request $request, EntityManagerInterface $entityManager): Response
    {
        $micropost = new MicroPost();
        $form = $this->createForm(MicroPostFormType::class, $micropost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($micropost);
            $entityManager->flush();

            $this->addFlash('success', 'Post created!');

            return $this->redirectToRoute('micropost_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('micro_post/store.html.twig', [
            'micropost' => $micropost,
            'form' => $form
        ]);
    }
}
