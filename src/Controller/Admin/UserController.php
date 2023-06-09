<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/admin/users', name: 'app_users')]
    public function index(): Response
    {
        return $this->render('admin/user/users.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
