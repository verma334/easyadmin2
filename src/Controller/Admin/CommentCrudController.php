<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }
    public function configureActions(Actions $actions): Actions
    {

        return $actions
             ->setPermission(Action::DELETE, 'ROLE_ADMIN')
             ->setPermission(Action::EDIT, 'ROLE_ADMIN');
             #->disable(Action::DELETE) ;
    }



    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('commentBy')->hideOnForm(),
            TextField::new('content'),
            BooleanField::new('status'),
            
        ];
    }
    
}