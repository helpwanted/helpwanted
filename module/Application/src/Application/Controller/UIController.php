<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class UIController
 * @package Application\Controller
 * @author Chuck "MANCHUCK" Reeves <chuck@manchuck.com>
 */
class UIController extends AbstractActionController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setTemplate('app.phtml');
        return $viewModel;
    }
}
