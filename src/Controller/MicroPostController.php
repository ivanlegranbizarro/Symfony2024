<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Form\CommentType;
use App\Form\MicroPostFormType;
use App\Repository\MicroPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/micropost', name: 'micropost_')]
class MicroPostController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(MicroPostRepository $repository): Response
    {
        $microposts = $repository->findAllMicroPostsWithCommentsAndAuthor();
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
            $micropost->setAuthor($this->getUser());
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


    #[Route(
        '/{micropost}/update',
        name: 'update',
        methods: ['GET', 'POST'],
        priority: 3
    )]
    public function update(Request $request, EntityManagerInterface $entityManager, MicroPost $micropost): Response
    {
        $form = $this->createForm(MicroPostFormType::class, $micropost, [
            'button_label' => 'Update'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Post updated!');
            return $this->redirectToRoute('micropost_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('micro_post/update.html.twig', [
            'micropost' => $micropost,
            'form' => $form
        ]);
    }

    #[Route('/{micropost}/add_comment', name: 'add_comment', methods: ['POST', 'GET'], priority: 4)]
    public function add_comment_to_micropost(Request $request, EntityManagerInterface $entityManager, MicroPost $micropost): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setMicroPost($micropost);
            $comment->setAuthor($this->getUser());

            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Comment added!');

            return $this->redirectToRoute('micropost_show', ['micropost' => $micropost->getId()]);
        }

        return $this->render('micro_post/comment.html.twig', [
            'micropost' => $micropost,
            'form' => $form
        ]);
    }
}
