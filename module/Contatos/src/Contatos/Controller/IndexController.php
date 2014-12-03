<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Contatos\Controller;

use Zend\Db\Sql\Select;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Contatos\Model\Contatos;
use Contatos\Form\ContatosForm;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
    protected $contatosTable;
    protected $homeTable;
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        $this->headTitleHelper = $this->getServiceLocator()->get('viewHelperManager')->get('headTitle');
        $this->headTitleHelper->append('Contatos');
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
    
    public function getContatosTable() {
        if (!$this->contatosTable) {
            $sm = $this->getServiceLocator();
            $this->contatosTable = $sm->get('Contatos\Model\ContatosTable');
        }
        return $this->contatosTable;
    }
    
    public function listacontatosAction()
    {
        echo $this->getContatosTable()->getContatos();
        exit();
    }
    
    public function addAction()
    {
        $form = new ContatosForm;
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $contato = new Contatos();
            $form->setData($request->getPost());
            $contato = $request->getPost();
            
            $view = new ViewModel(array(
                'mensagem' => $this->getContatosTable()->saveContato($contato),
                'form' => $form
            ));
            $view->setTemplate('contatos/index/add');
            return $view;
        }

        $view = new ViewModel(array(
            'form' => $form
        ));
        $view->setTemplate('contatos/index/add');
        return $view;
    }
    
    public function editAction() {
        $id = (int)$this->params('form_codigo');
        if (!$id) {
            return $this->redirect()->toRoute('contatos', array('action'=>'add'));
        }
        
        $contato = $this->getContatosTable()->getContato($id);

        $form = new ContatosForm();
        $form->bind($contato);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $contato = $request->getPost();
            
            $view = new ViewModel(array(
                'actions' => $contato,
                'mensagem' => $this->getContatosTable()->saveContato($contato),
                'form_codigo' => $id,
                'form' => $form,
            ));
            $view->setTemplate('contatos/index/edit');
            return $view;
        }
        $view = new ViewModel(array(
            'actions' => $contato,
            'form_codigo' => $id,
            'form' => $form,
        ));
       $view->setTemplate('contatos/index/edit');
        return $view;
    }
    
    public function delAction()
    {
        $id = (int)$this->params('form_codigo');
        if (!$id) {
            return $this->redirect()->toRoute('contatos');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost()->get('del', 'Cancelar');
            if ($del == 'Confirmar') {
                $id = (int)$request->getPost()->get('form_codigo');
                $this->getContatosTable()->deleteContato($id);
            }
            return $this->redirect()->toRoute('contatos');
        }
        
        $contato = $this->getContatosTable()->getContato($id);
        
        $view = new ViewModel(array(
            'form_codigo' => $id,
            'contato' => $contato
        ));
        $view->setTemplate('contatos/index/del');
        return $view;
    }
    
    public function indexAction()
    {
        $view = new ViewModel(array(
            'users' => $this->getHomeTable()->getUsers(),
        ));
        $view->setTemplate('contatos/index/index');
        return $view;
    }
}
