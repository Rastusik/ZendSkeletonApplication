<?php

namespace BlogTestAsset\Fixture;


use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Blog\Entity\BlogPost;
use Blog\Entity\Comment;

class SingleBlogPostFixture implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $blogPost = new BlogPost();

        $blogPost->setTitle($faker->text);
        $blogPost->setContent($faker->text);
        //$blogPost->setAuthor($faker->name);

        $comment = new Comment($blogPost);

        $comment->setAuthor($faker->name);
        $comment->setContent($faker->text);

        $manager->persist($blogPost);
        $manager->persist($comment);

        $manager->flush();
    }
}
