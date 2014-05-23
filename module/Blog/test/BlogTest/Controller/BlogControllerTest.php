<?php

namespace BlogTest\Controller;

use Blog\Controller\BlogController;
use Blog\Entity\Comment;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use PHPUnit_Framework_TestCase;
use Zend\Http\Header\Location;
use Zend\Http\Response;
use Zend\Mvc\Controller\Plugin\PluginInterface;

/**
 * @covers \Blog\Controller\BlogController
 */
class BlogControllerTest extends PHPUnit_Framework_TestCase
{
    public function testDeleteCommentAction()
    {
        /* @var $objectManager ObjectManager|\PHPUnit_Framework_MockObject_MockObject */
        $objectManager    = $this->getMock(ObjectManager::class);
        /* @var $objectRepository ObjectRepository|\PHPUnit_Framework_MockObject_MockObject */
        $objectRepository = $this->getMock(ObjectRepository::class);
        $comment          = $this->getMockBuilder(Comment::class)->disableOriginalConstructor()->getMock();

        $objectRepository->expects($this->any())->method('find')->with(123)->will($this->returnValue($comment));
        $objectManager->expects($this->once())->method('remove')->with($comment);
        $objectManager->expects($this->once())->method('flush');

        $controller = new BlogController($objectManager, $objectRepository);

        $this->populateControllerPlugins($controller);

        /* @var $response Response */
        $response = $controller->deleteCommentAction();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->getHeaders()->has('Location'));
    }

    private function populateControllerPlugins(BlogController $controller)
    {
        $pluginManager = $controller->getPluginManager();

        $redirectPlugin = $this->getMock(PluginInterface::class, ['setController', 'getController', 'toRoute']);
        $paramsPlugin   = $this->getMock(PluginInterface::class, ['setController', 'getController', 'fromRoute']);

        $response = new Response();

        $response->getHeaders()->addHeader(Location::fromString('Location: /redirect-url'));

        $redirectPlugin
            ->expects($this->any())
            ->method('toRoute')
            ->with($this->isType('string'))
            ->will($this->returnValue($response));
        $paramsPlugin
            ->expects($this->any())
            ->method('fromRoute')
            ->with($this->isType('string'))
            ->will($this->returnValue(123));

        $pluginManager->setAllowOverride(true);
        $pluginManager->setService('redirect', $redirectPlugin);
        $pluginManager->setService('params', $paramsPlugin);
    }
}
