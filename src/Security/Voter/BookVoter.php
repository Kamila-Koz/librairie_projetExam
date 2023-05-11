<?php

namespace App\Security\Voter;

use App\Entity\Book;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class BookVoter extends Voter
{
    const UPDATE = 'BOOK_UPDATE';
    const DELETE = 'BOOK_DELETE';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $book): bool
    {
        if(!in_array($attribute, [self::UPDATE, self::DELETE])) {
            return false;
        }
        if(!$book instanceof Book){
            return false;
        }
        return true;
    }

    protected function voteOnAttribute($attribute, $book, TokenInterface $token): bool
    {
        //on récup l'utilisateur à partir du token
        $user = $token->getUser();

        if(!$user instanceof UserInterface) return false;

        //on vérifie si l'utilisateur est admin
        if($this->security->isGranted('ROLE_ADMIN')) return true;

        //on vérifie les permissions
        switch($attribute){
            case self::UPDATE:
                return $this->canUpdate();
                break;
            case self::DELETE:
                return $this->canDelete();
                break;
        }
    }

    private function canUpdate(){
        return $this->security->isGranted('ROLE_ADMIN');
    }
    
    private function canDelete(){
        return $this->security->isGranted('ROLE_ADMIN');
    }

}
