<?php
 namespace App\EventSubscriber;

 use App\Entity\Category;
 use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
 use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
 use Symfony\Component\EventDispatcher\EventSubscriberInterface;
 use Symfony\Component\Security\Core\Security;
 use Symfony\Component\String\Slugger\SluggerInterface;
 

 class CategoryEventSubscriber implements EventSubscriberInterface {
     private $slugger;

     public function __construct(Security $security, SluggerInterface $slugger) {
         $this->slugger = $slugger;
         $this->security = $security;
     }

     public static function getSubscribedEvents(){
         return [
             BeforeEntityPersistedEvent::class => ['setCategory'],
             BeforeEntityUpdatedEvent::class => ['updateCategory'],
         ];
     }

     public function setCategory(BeforeEntityPersistedEvent $event){
         $entity = $event->getEntityInstance();
         if ($entity instanceof Category) {
            
             $entity->setCreatedAt(new \DateTime());
             $entity->setUpdatedAt(new \DateTime());
             
         }
         
         return;
     }

     public function updateCategory(BeforeEntityUpdatedEvent $event){
         $entity = $event->getEntityInstance();
         if ($entity instanceof Category) {
            
             $entity->setUpdatedAt(new \DateTime());
         }
         
         return;
     }
 }