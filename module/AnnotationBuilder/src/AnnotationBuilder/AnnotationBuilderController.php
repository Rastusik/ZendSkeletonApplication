<?php

namespace AnnotationBuilder;

use AnnotationBuilder\Entity\BlogPost;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Mvc\Controller\AbstractActionController;

class AnnotationBuilderController extends AbstractActionController
{
    public function indexAction()
    {
        $annotationBuilder = new AnnotationBuilder();
        $blogPost          = new BlogPost();

        $form = $annotationBuilder->createForm($blogPost);

        return ['blogPostForm' => $form];
    }
}
