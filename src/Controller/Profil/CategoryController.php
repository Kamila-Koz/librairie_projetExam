<?php

namespace App\Controller\Front;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/categories', name: 'categories_list')]
    public function categoriesList(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('profil/category/list.html.twig', ['categories' => $categories]);
    }

    #[Route('/category/{id}', name: 'category_show')]
    public function categoryShow($id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);
        
        //chercher tous les livres de la catégorie
        $books = $category->getBooks();

        return $this->render('profil/category/show.html.twig', ['category' => $category, 'books' => $books]);
    }
}