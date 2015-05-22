<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;

/**
 * Class SidebarAdminController
 * @package Application\Controller
 */
class SidebarAdminController extends AbstractActionController
{
    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $view = new ViewModel();
        $view->setTerminal(true);
        $view->setTemplate('sidebar.phtml');

        return $view;
    }
}
