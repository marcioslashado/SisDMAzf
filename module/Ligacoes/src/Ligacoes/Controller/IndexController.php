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
    
    public function indexAction()
    {
        $view = new ViewModel(array(
            
        ));
        $view->setTemplate('ligacoes/index/index');
        return $view;
    }
}
