<?php

namespace Blog\Controller;

use Blog\Entity\Comment;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use DoctrineModule\Form\Element\ObjectSelect;
use Zend\Mvc\Controller\AbstractActionController;

class BlogController extends AbstractActionController
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private $objectManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    public function __construct(ObjectManager $objectManager, ObjectRepository $repository)
    {
        $this->objectManager = $objectManager;
        $this->repository    = $repository;
    }

    public function homepageAction()
    {
        return ['blogPosts' => $this->repository->findBy([], ['id' => Criteria::DESC])];
    }

    public function blogpostAction()
    {
        $id = (int) $this->params()->fromRoute('blogPostId');

        /* @var $blogPost \Blog\Entity\BlogPost */
        if (! $blogPost = $this->repository->find($id)) {
            return $this->notFoundAction();
        }

        if ($this->params()->fromPost()) {
            // @TODO validation

            $content = $this->params()->fromPost('content', '');
            $author  = $this->params()->fromPost('author', '');

            $comment = new Comment($blogPost);

            $comment->setContent($content);
            $comment->setAuthor($author);

            $this->objectManager->persist($comment);
            $this->objectManager->flush();
        }

        return [
            'blogPost' => $blogPost,
            'form' => $this->getCommentForm()
        ];
    }

    public function deleteCommentAction()
    {
        $commentId = (int) $this->params()->fromRoute('commentId', '');

        if (! $comment = $this->repository->find($commentId)) {
            return $this->notFoundAction();
        }

        $this->objectManager->remove($comment);
        $this->objectManager->flush();

        return $this->redirect()->toRoute('blogpost', ['blogPostId' => $this->params()->fromRoute('blogPostId', '')]);
    }

    private function getCommentForm()
    {
        $form = new \Zend\Form\Form();
        $form->add(array(
            'type' => ObjectSelect::class,
            'name' => 'comment',
            'options' => array(
                'object_manager' => $this->objectManager,
                'target_class'   => Comment::class,
                'property'       => 'author',
            ),
        ));

        return $form;
    }
}
