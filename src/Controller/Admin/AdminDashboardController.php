<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class AdminDashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routerBuilder=$this->get(CrudUrlGenerator::class)->build();
        return $this->redirect($routerBuilder->setController
        (UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Easyadmin2');
    }

    public function configureMenuItems(): iterable
    { 
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home')->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Post', 'fas fa-list', Post::class);
        yield MenuItem::linkToCrud('Comment', 'fas fa-list', Comment::class);
    }
}
