<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'app_hello', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }

    #[Route('/hello/{name}', name: 'app_hello_someone', requirements: ['name' => '\w+'], methods: ['GET'])]
    public function hello(string $name): Response
    {
        $message = "Hello $name";

        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
            'message' => $message,
        ]);
    }
}
