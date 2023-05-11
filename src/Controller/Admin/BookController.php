<?php

namespace App\Controller\Admin;

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

    #[Route('/admin/books', name: 'admin_books_list')]
    public function booksList(BookRepository $bookRepository)
    {
        // finAll() récupère tous les livres enregistrés dans la BDD.
        $books = $bookRepository->findAll();

        return $this->render("admin/book/list.html.twig", ['books' => $books]);
    }

    #[Route('/admin/book/update/{id}', name: 'admin_book_update')]
    public function bookUpdate(
        $id, 
        BookRepository $bookRepository,
        EntityManagerInterface $entityManagerInterface,
        Request $request)
        {
            $book = $bookRepository->find($id);
            
            $bookForm = $this->createForm(BookType::class, $book);
            $bookForm->handleRequest($request);

            if($bookForm->isSubmitted() && $bookForm->isValid()){
                $entityManagerInterface->persist($book);
                $entityManagerInterface->flush();
    
                return $this->redirectToRoute("books_list");
            }  
            return $this->render("admin/book/create.html.twig", ['bookForm' => $bookForm->createView()]);
        }

    #[Route('/admin/book/new', name: 'admin_book_new')]
    public function bookNew(
        EntityManagerInterface $entityManagerInterface,
        Request $request)
        {
            //on crée un "nouveau livre"
            $book = new Book();
            
            //on crée le formulaire
            $bookForm = $this->createForm(BookType::class, $book);
            $bookForm->handleRequest($request);
           
            if($bookForm->isSubmitted() && $bookForm->isValid()){
                $entityManagerInterface->persist($book);
                $entityManagerInterface->flush();

                return $this->redirectToRoute("admin_books_list");    
            }  
            return $this->render('admin/book/create.html.twig', [
                'bookForm' => $bookForm->createView()]);
        }

    #[Route('/admin/book/{id}', name: 'admin_book_show')]
        public function bookShow($id, BookRepository $bookRepository)
        {
            $book = $bookRepository->find($id);

            return $this->render("admin/book/show.html.twig", ['book' => $book]);
        }

    #[Route('/admin/book/delete/{id}', name: 'admin_book_delete')]
        public function bookDelete(
            $id,
            BookRepository $bookRepository,
            EntityManagerInterface $entityManagerInterface)
            {
                $book = $bookRepository->find($id);
                
                $entityManagerInterface->remove($book);
                $entityManagerInterface->flush();
        
                return $this->redirectToRoute("admin_books_list");
            }
}
