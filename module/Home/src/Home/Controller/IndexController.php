<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Home\Controller;

use Zend\Db\Sql\Select;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Home\Model\HomeTable;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController {

    protected $homeTable;

    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        $this->headTitleHelper = $this->getServiceLocator()->get('viewHelperManager')->get('headTitle');
        $this->headTitleHelper->append('Página Inicial');

        parent::onDispatch($e);
    }

    public function getHomeTable() {
        if (!$this->homeTable) {
            $sm = $this->getServiceLocator();
            $this->homeTable = $sm->get('Home\Model\HomeTable');
        }
        return $this->homeTable;
    }

    public function updateUserAction() {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $user = $request->getPost();
            //print_r($user);
            $this->getHomeTable()->updateUser($user);
            exit();
        }
        exit();
    }

    public function indexAction() {
        $view = new ViewModel(array(
            'agenda_dia' => $this->getHomeTable()->getAgenda(),
            'ligacoes_dia' => $this->getHomeTable()->getLigacoes(),
            'users' => $this->getHomeTable()->getUsers(),
        ));
        $view->setTemplate('home/index/index');
        return $view;
    }

}
