<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class InformationController extends AbstractController
{
    #[Route('/', name: 'app_information')]
    public function index(): Response
    {
        return $this->render('information/index.html.twig');
    }
}