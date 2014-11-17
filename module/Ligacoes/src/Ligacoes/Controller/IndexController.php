<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Ligacoes\Controller;

use Zend\Db\Sql\Select;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Ligacoes\Model\Ligacoes;
use Ligacoes\Form\LigacoesForm;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
    protected $ligacoesTable;
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        $this->headTitleHelper = $this->getServiceLocator()->get('viewHelperManager')->get('headTitle');
        $this->headTitleHelper->append('Ligações');
        parent::onDispatch($e);
    }
    
    public function getLigacoesTable() {
        if (!$this->ligacoesTable) {
            $sm = $this->getServiceLocator();
            $this->ligacoesTable = $sm->get('Ligacoes\Model\LigacoesTable');
        }
        return $this->ligacoesTable;
    }
    
    public function listaligacoesAction()
    {
        echo $this->getLigacoesTable()->getLigacoes();
        exit();
    }
    
    public function addAction()
    {
        $form = new LigacoesForm;
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $ligacao = new Ligacoes();
            $form->setData($request->getPost());
            $ligacao = $request->getPost();
            
            $view = new ViewModel(array(
                'mensagem' => $this->getLigacoesTable()->saveLigacao($ligacao),
                'form' => $form
            ));
            $view->setTemplate('ligacoes/index/add');
            return $view;
        }

        $view = new ViewModel(array(
            'form' => $form
        ));
        $view->setTemplate('ligacoes/index/add');
        return $view;
    }
    
    public function editAction() {
        $id = (int)$this->params('form_codigo');
        if (!$id) {
            return $this->redirect()->toRoute('ligacoes', array('action'=>'add'));
        }
        $ligacao = $this->getLigacoesTable()->getLigacao($id);

        $form = new LigacoesForm();
        $form->bind($ligacao);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $ligacao = $request->getPost();
            
            $view = new ViewModel(array(
                'mensagem' => $this->getLigacoesTable()->saveLigacao($ligacao),
                'form_codigo' => $id,
                'form' => $form,
            ));
            $view->setTemplate('ligacoes/index/edit');
            return $view;
        }
        $view = new ViewModel(array(
            'form_codigo' => $id,
            'form' => $form,
        ));
       $view->setTemplate('ligacoes/index/edit');
        return $view;
    }
    
    public function delAction()
    {
        $id = (int)$this->params('form_codigo');
        if (!$id) {
            return $this->redirect()->toRoute('ligacoes');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost()->get('del', 'Cancelar');
            if ($del == 'Confirmar') {
                $id = (int)$request->getPost()->get('form_codigo');
                $this->getLigacoesTable()->deleteLigacao($id);
            }
            return $this->redirect()->toRoute('ligacoes');
        }
        
        $ligacao = $this->getLigacoesTable()->getLigacao($id);
        
        $view = new ViewModel(array(
            'form_codigo' => $id,
            'ligacao' => $ligacao
        ));
        $view->setTemplate('ligacoes/index/del');
        return $view;
    }
    
    public function anotacoesAction()
    {
        $id = (int)$this->params('form_codigo');
        if (!$id) {
            return $this->redirect()->toRoute('ligacoes');
        }
        $ligacao = $this->getLigacoesTable()->getLigacao($id);

        $form = new LigacoesForm();
        $form->bind($ligacao);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $ligacao = $request->getPost();
            
            $view = new ViewModel(array(
                'mensagem' => $this->getLigacoesTable()->saveAnotacao($ligacao),
                'form_codigo' => $id,
                'form' => $form,
            ));
            $view->setTemplate('ligacoes/index/anotacoes');
            return $view;
        }
        $view = new ViewModel(array(
            'form_codigo' => $id,
            'form' => $form,
        ));
       $view->setTemplate('ligacoes/index/anotacoes');
        return $view;
    }
    
    public function viewAction()
    {
        $id = (int)$this->params('form_codigo');
        if (!$id) {
            return $this->redirect()->toRoute('ligacoes');
        }        
        
        $ligacao = $this->getLigacoesTable()->getLigacao($id);
        $log = $this->getLigacoesTable()->getDetalhes($id);
        $view = new ViewModel(array(
            'form_codigo' => $id,
            'ligacao' => $ligacao, 
            'log' => $log, 
        ));
        $view->setTemplate('ligacoes/index/detalhes');
        return $view;
    }
    
    public function indexAction()
    {
        $view = new ViewModel(array(
        ));
        $view->setTemplate('ligacoes/index/index');
        return $view;
    }
}
