<?php

namespace App\Controller\Profil;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{

    #[Route('/books', name: 'books_list')]
    public function booksList(BookRepository $bookRepository)
    {
        // finAll() récupère tous les livres enregistrés dans la BDD.
        $books = $bookRepository->findAll();

        return $this->render("profil/book/list.html.twig", ['books' => $books]);
    }


    #[Route('/book/{id}', name: 'book_show')]
    public function bookShow($id, BookRepository $bookRepository)
    {
        $book = $bookRepository->find($id);

        return $this->render("profil/book/show.html.twig", ['book' => $book]);
    }

   
}
