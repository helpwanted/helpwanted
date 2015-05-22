<?php

namespace ApplicationTest\Controller;

use Application\Controller\SidebarAdminController;
use \PHPUnit_Framework_TestCase as TestCase;

/**
 * Class SidebarAdminControllerTest
 * @package ApplicationTest\Controller
 */
class SidebarAdminControllerTest extends TestCase
{
    public function testItsShouldCreateViewModelWhenIndexActionIsCalled()
    {
        $UiController = new SidebarAdminController();
        $viewModel = $UiController->indexAction();

        $this->assertInstanceOf(
            'Zend\View\Model\ViewModel',
            $viewModel,
            'Failed to create ViewModel'
        );
    }
}
