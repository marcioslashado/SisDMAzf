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

class IndexController extends AbstractActionController
{
    protected $agendaTable;
    protected $ligacoesTable;
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        $this->headTitleHelper = $this->getServiceLocator()->get('viewHelperManager')->get('headTitle');
        $this->headTitleHelper->append('Página Inicial');
        
        parent::onDispatch($e);
    }

    public function getAgendaTable() {
        if (!$this->agendaTable) {
            $sm = $this->getServiceLocator();
            $this->agendaTable = $sm->get('Home\Model\HomeTable');
        }
        return $this->agendaTable;
    }
    
    public function getLigacoesTable() {
        if (!$this->ligacoesTable) {
            $sm = $this->getServiceLocator();
            $this->ligacoesTable = $sm->get('Home\Model\HomeTable');
        }
        return $this->ligacoesTable;
    }

    public function indexAction()
    {          
            $view = new ViewModel(array(
                'agenda_dia' => $this->getAgendaTable()->getAgenda(),
                'ligacoes_dia' => $this->getAgendaTable()->getLigacoes(),
            ));
            $view->setTemplate('home/index/index');
            return $view;
    }
}
