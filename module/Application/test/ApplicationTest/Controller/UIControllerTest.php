<?php

namespace ApplicationTest\Controller;

use Application\Controller\UIController;
use \PHPUnit_Framework_TestCase as TestCase;

/**
 * Class UIControllerTest
 * @package ApplicationTest\Controller
 * @author John Franco <jfranco@salesandorders.com>
 */
class UIControllerTest extends TestCase
{
    public function testItsShouldCreateViewModelWhenIndexActionIsCalled()
    {
        $UiController = new UIController();
        $viewModel = $UiController->indexAction();

        $this->assertInstanceOf(
            'Zend\View\Model\ViewModel',
            $viewModel,
            'Failed to create ViewModel'
        );
    }
}
