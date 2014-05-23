<?php

namespace BlogTest\Controller;

use Blog\Controller\BlogController;
use Blog\Entity\Comment;
use Blog\Entity\BlogPost;
use BlogTestAsset\Fixture\MultipleBlogPostsFixture;
use BlogTestAsset\Fixture\SingleBlogPostFixture;
use BlogTestAsset\Util\ModuleLoaderFactory;
use Doctrine\Common\DataFixtures\Executor\AbstractExecutor;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\Tools\SchemaTool;
use Faker\Factory;
use PHPUnit_Framework_TestCase;
use Zend\Console\Console;
use Zend\Http\Header\Location;
use Zend\Http\Response;
use Zend\Mvc\Controller\Plugin\PluginInterface;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Test\Util\ModuleLoader;

/**
 * @coversNothing
 */
class BlogControllerFunctionalTest extends AbstractHttpControllerTestCase
{
    /**
     * @var ModuleLoader
     */
    private $moduleLoader;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    public function setUp()
    {
        parent::setUp();

        Console::overrideIsConsole(false);

        $this->moduleLoader  = (new ModuleLoaderFactory())->createModuleLoader();
        $this->repository = $this
            ->moduleLoader
            ->getServiceManager()
            ->get('doctrine.entitymanager.orm_default')
            ->getRepository(BlogPost::class);

        /* @var $executor AbstractExecutor */
        $executor = $this->moduleLoader->getServiceManager()->get(AbstractExecutor::class);

        $executor->execute([new SingleBlogPostFixture()]);

        $this->application = $this->moduleLoader->getApplication();

        $this->application->bootstrap();
    }

    public function testBlogPostDeletion()
    {
        $comments = $this->repository->findAll();

        $this->assertNotEmpty($comments);

        $this->dispatch('/blog/1/deleteComment/1');

        $this->assertResponseStatusCode(302);
        $this->assertControllerName(BlogController::class);
        $this->assertActionName('delete-comment');

        $this->assertEmpty($this->repository->findAll());
    }
}
