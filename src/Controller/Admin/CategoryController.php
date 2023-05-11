<?php

namespace App\Controller\Admin;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/admin/category', name: 'admin_app_category')]
    public function index(): Response
    {
        return $this->render('admin/category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/admin/categories', name: 'admin_categories_list')]
    public function categoriesList(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('admin/category/list.html.twig', ['categories' => $categories]);
    }

    #[Route('/admin/category/{id}', name: 'admin_category_show')]
    public function categoryShow($id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);
        
        //chercher tous les livres de la catégorie
        $books = $category->getBooks();

        return $this->render('admin/category/show.html.twig', ['category' => $category, 'books' => $books]);
    }
}