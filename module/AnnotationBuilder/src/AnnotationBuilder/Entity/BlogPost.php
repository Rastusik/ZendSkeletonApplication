<?php

namespace AnnotationBuilder\Entity;

use Zend\Form\Annotation\Name;
use Zend\Form\Annotation\Hydrator;
use Zend\Form\Annotation\Options;
use Zend\Form\Annotation\Type;

/**
 * @Name("blog_post")
 * @Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class BlogPost
{
    /**
     * @Options({"label": "Main Content"})
     * @Type("Textarea")
     */
    private $content;
}