<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Comunicacoes\Controller;

use Zend\Db\Sql\Select;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Comunicacoes\Model\Comunicacoes;
use Comunicacoes\Form\ComunicacoesForm;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
    protected $comunicacoesTable;
    protected $homeTable;
    protected $contatosTable;
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        $this->headTitleHelper = $this->getServiceLocator()->get('viewHelperManager')->get('headTitle');
        $this->headTitleHelper->append('Comunicações');
        parent::onDispatch($e);
    }
    
    public function getHomeTable() {
        if (!$this->homeTable) {
            $sm = $this->getServiceLocator();
            $this->homeTable = $sm->get('Home\Model\HomeTable');
        }
        return $this->homeTable;
    }
    
    public function getComunicacoesTable() {
        if (!$this->comunicacoesTable) {
            $sm = $this->getServiceLocator();
            $this->comunicacoesTable = $sm->get('Comunicacoes\Model\ComunicacoesTable');
        }
        return $this->comunicacoesTable;
    }
    
    public function getContatosTable() {
        if (!$this->contatosTable) {
            $sm = $this->getServiceLocator();
            $this->contatosTable = $sm->get('Contatos\Model\ContatosTable');
        }
        return $this->contatosTable;
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
    
    public function listacomunicacoesAction()
    {
        echo $this->getComunicacoesTable()->getComunicacoes();
        exit();
    }
    
    public function getEtapasAction() {
        $id = filter_input(INPUT_GET, 'proj_id');
        $etapas = $this->getComunicacoesTable()->getEtapas($id); //print_r($projetos) para debugar
        return $etapas; //Retorna no formato JsonModel(Json) solicitado pelo Formulário
    }
    
    public function addAction()
    {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $form = new ComunicacoesForm($dbAdapter);
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $comunicacao = new Comunicacoes();
            $form->setData($request->getPost());
            $comunicacao = $request->getPost();
            
            $view = new ViewModel(array(
                'mensagem' => $this->getComunicacoesTable()->saveComunicacao($comunicacao),
                'form' => $form
            ));
            $view->setTemplate('comunicacoes/index/add');
            return $view;
        }
        
        $view = new ViewModel(array(
            'form' => $form
        ));
        $view->setTemplate('comunicacoes/index/add');
        return $view;
    }
    
    public function editAction() {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $id = (int)$this->params('form_codigo');
        if (!$id) {
            return $this->redirect()->toRoute('comunicacoes', array('action'=>'add'));
        }
        
        $comunicacao = $this->getComunicacoesTable()->getComunicacao($id);
        $form = new ComunicacoesForm($dbAdapter);
        $form->bind($comunicacao);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $comunicacao = $request->getPost();
            
            $view = new ViewModel(array(
                'form_codigo' => $id,
                'form' => $form,
            ));
            $view->setTemplate('comunicacoes/index/edit');
            return $view;
        }
        $view = new ViewModel(array(
            'form_codigo' => $id,
            'form' => $form,
        ));
       $view->setTemplate('comunicacoes/index/edit');
        return $view;
    }
    
    public function delAction()
    {
        $id = (int)$this->params('form_codigo');
        if (!$id) {
            return $this->redirect()->toRoute('comunicacoes');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost()->get('del', 'Cancelar');
            if ($del == 'Confirmar') {
                $id = (int)$request->getPost()->get('form_codigo');
                $this->getComunicacoesTable()->deleteLigacao($id);
            }
            return $this->redirect()->toRoute('comunicacoes');
        }
        
        $comunicacao = $this->getComunicacoesTable()->getComunicacao($id);
        
        $view = new ViewModel(array(
            'form_codigo' => $id,
            'ligacao' => $comunicacao
        ));
        $view->setTemplate('comunicacoes/index/del');
        return $view;
    }
    
    public function anotacoesAction()
    {
        $id = (int)$this->params('form_codigo');
        if (!$id) {
            return $this->redirect()->toRoute('comunicacoes');
        }
        $comunicacao = $this->getComunicacoesTable()->getComunicacao($id);

        $form = new ComunicacoesForm();
        $form->bind($comunicacao);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $comunicacao = $request->getPost();
            
            $view = new ViewModel(array(
                'mensagem' => $this->getComunicacoesTable()->saveAnotacao($comunicacao),
                'form_codigo' => $id,
                'form' => $form,
            ));
            $view->setTemplate('comunicacoes/index/anotacoes');
            return $view;
        }
        $view = new ViewModel(array(
            'form_codigo' => $id,
            'form' => $form,
        ));
       $view->setTemplate('comunicacoes/index/anotacoes');
        return $view;
    }
    
    public function viewAction()
    {
        $id = (int)$this->params('form_codigo');
        if (!$id) {
            return $this->redirect()->toRoute('comunicacoes');
        }        
        
        $comunicacao = $this->getComunicacoesTable()->getComunicacao($id);
        $log = $this->getComunicacoesTable()->getDetalhes($id);
        $view = new ViewModel(array(
            'form_codigo' => $id,
            'ligacao' => $comunicacao, 
            'log' => $log, 
        ));
        $view->setTemplate('comunicacoes/index/detalhes');
        return $view;
    }
    
    public function indexAction()
    {
        $view = new ViewModel(array(
            'users' => $this->getHomeTable()->getUsers(),
        ));
        $view->setTemplate('comunicacoes/index/index');
        return $view;
    }
}
