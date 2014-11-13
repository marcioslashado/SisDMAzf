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
use Contatos\Form\ModulosForm;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
    protected $contatosTable;
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        $this->headTitleHelper = $this->getServiceLocator()->get('viewHelperManager')->get('headTitle');
        $this->headTitleHelper->append('Contatos');
        parent::onDispatch($e);
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
    
    public function indexAction()
    {
        $view = new ViewModel(array(
            
        ));
        $view->setTemplate('contatos/index/index');
        return $view;
    }
}
