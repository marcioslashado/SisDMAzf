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

class IndexController extends AbstractActionController {

    protected $agendaTable;
     protected $homeTable;

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

    public function listAgendaAction() {
        echo $this->getAgendaTable()->getAgenda();
        exit();
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

    //ADD ou Editar Agenda
    public function addeditAgendaAction() {
        $request = $this->getRequest();
        $count = strlen($_POST['ids']);
        if ($count > 11) {
            $a = array(
                'start_date',
                'end_date',
                'text',
                'id',
                'event_pid',
                'event_length',
                'rec_pattern',
                'rec_type',
                'details',
                'convidados',
                'event_location',
                'nativeeditor_status',
                'ids',
            );
            $b = $_POST;
            $calendar = array_combine($a, $b); //Dá fim nas ids aleatórias dos campos
        } else {
            $a = array(
                'id',
                'start_date',
                'end_date',
                'text',
                'details',
                'convidados',
                'event_location',
                'nativeeditor_status',
                'ids',
            );
            $b = $_POST;
            $calendar = array_combine($a, $b); //Dá fim nas ids aleatórias dos campos
        }

        if ($request->isPost()) {
            $this->getAgendaTable()->saveAgenda($calendar);
            exit();
        }
        exit();
    }

    public function indexAction() {
        $view = new ViewModel(array(
            'users' => $this->getHomeTable()->getUsers(),
        ));
        $view->setTemplate('agenda/index/index');
        return $view;
    }

}
