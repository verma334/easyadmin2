<?php
 namespace App\EventSubscriber;

 use App\Entity\Comment;
 use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
 use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
 use Symfony\Component\EventDispatcher\EventSubscriberInterface;
 use Symfony\Component\Security\Core\Security;
 use Symfony\Component\String\Slugger\SluggerInterface;

 class CommentEventSubscriber implements EventSubscriberInterface {
     private $slugger;

     public function __construct(Security $security, SluggerInterface $slugger) {
         $this->slugger = $slugger;
         $this->security = $security;
     }

     public static function getSubscribedEvents(){
         return [
             BeforeEntityPersistedEvent::class => ['setComment'],
             BeforeEntityUpdatedEvent::class => ['updateComment'],
         ];
     }

     public function setComment(BeforeEntityPersistedEvent $event){
         $entity = $event->getEntityInstance();
         if ($entity instanceof Comment) {
            
             $entity->setCommentBy($this->security->getUser());
            
             
         }
         
         return;
     }

     public function updateComment(BeforeEntityUpdatedEvent $event){
         $entity = $event->getEntityInstance();
         if ($entity instanceof Comment) {
            
            $entity->setCommentBy($this->security->getUser());
         }
         
         return;
     }
 }
	
	
	
