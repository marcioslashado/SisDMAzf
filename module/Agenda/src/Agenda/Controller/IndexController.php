<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Agenda\Controller;

use Zend\Db\Sql\Select;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Agenda\Model\Agenda;
use Agenda\Form\AgendaForm;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
    protected $agendaTable;
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        $this->headTitleHelper = $this->getServiceLocator()->get('viewHelperManager')->get('headTitle');
        $this->headTitleHelper->append('Agenda');
        parent::onDispatch($e);
    }
    
    public function getAgendaTable() {
        if (!$this->agendaTable) {
            $sm = $this->getServiceLocator();
            $this->agendaTable = $sm->get('Agenda\Model\AgendaTable');
        }
        return $this->agendaTable;
    }
    
    public function listAgendaAction()
    {
        echo $this->getAgendaTable()->getAgenda();
        exit();
    }
    
    //ADD ou Editar Agenda
    public function addeditAgendaAction()
    {
        if(isset($_POST)){
            print_r($_POST);
        }
        exit();
    }
   
    public function indexAction()
    {
//        if(isset($_POST)){
//            print_r($_POST);
//        }
        return new ViewModel();
    }
}
