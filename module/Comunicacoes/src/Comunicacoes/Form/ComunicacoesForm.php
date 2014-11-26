<?php
namespace Comunicacoes\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Db\Sql\Select;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;

class ComunicacoesForm extends Form {

    protected $adapter;

     public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        // we want to ignore the name passed
        parent::__construct('comunicacoes');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'form_codigo',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'form_origem',
            'attributes' => array(
                'type' => 'text',
                'id' => 'form_origem',
                'class' => 'form-control input-sm',
                'placeholder' => 'Membro da Equipe',
                'required' => 'required',
            ),
        ));
        $this->add(array(
            'name' => 'form_destino',
            'attributes' => array(
                'type' => 'text',
                'id' => 'form_destino',
                'class' => 'form-control input-sm',
                'placeholder' => 'Contato da Ligação',
                'required' => 'required',
            ),
        ));
        $this->add(array(
            'name' => 'form_assunto',
            'attributes' => array(
                'type' => 'text',
                'id' => 'form_destino',
                'class' => 'form-control input-sm',
                'placeholder' => 'Assunto desta ligação',
                'required' => 'required',
            ),
        ));
        $this->add(array(
            'name' => 'form_data',
            'attributes' => array(
                'type' => 'text',
                'id' => 'datahora',
                'class' => 'form-control input-sm',
                'placeholder' => '',
                'required' => 'required',
            ),
        ));
        $this->add(array(
            'name' => 'form_duracao',
            'attributes' => array(
                'type' => 'text',
                'id' => 'duracao',
                'class' => 'form-control input-sm',
                'placeholder' => 'Duração da ligação',
                'required' => 'required',
            ),
        ));
        $this->add(array(
            'name' => 'form_nota',
            'attributes' => array(
                'type' => 'textarea',
                'id' => 'nota',
                'class' => 'form-control input-sm',
                'placeholder' => '',
                'required' => 'required',
            ),
        ));
        $this->add(array(
            'name' => 'form_status',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'form_status',
                'class' => 'form-control',
                'required' => 'required',
            'value' => 'Realizado', //Mantém selecionado o valor '1'
            ),
            'options' => array(
                //'label' => 'Drop Down', 
                'value_options' => array(
                    'Realizado' => 'Realizado',
                    'Remarcado' => 'Remarcado',
                    'Pendente' => 'Pendente',
                    'Cancelado' => 'Cancelado',
                ),
            ),
        ));
        $this->add(array(
            'name' => 'form_tipo',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'form_tipo',
                'class' => 'form-control',
                'required' => 'required',
            'value' => 'Realizado', //Mantém selecionado o valor '1'
            ),
            'options' => array(
                //'label' => 'Drop Down', 
                'value_options' => array(
                    '1' => 'Enviado',
                    '2' => 'Recebido',
                ),
            ),
        ));
        $this->add(array(
            'name' => 'form_projeto',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'form_projeto',
                'class' => 'form-control',
                'value' => '', //Mantém selecionado o valor '1'
            ),
            'options' => array(
                'value_options' => $this->getOptionsForModulos(),
            ),
        ));
        $this->add(array(
            'name' => 'form_etapas',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'form_etapas',
                'class' => 'form-control',
                'value' => '', //Mantém selecionado o valor '1'
            ),
            'options' => array(
                //'label' => 'Drop Down', 
                'value_options' => array(
                    '' => ':: Selecione um Projeto ::',
                ),
            ),
        ));
    }
    
    public function getOptionsForModulos() {
        $sql = new Sql($this->adapter);
        $select = new Select(array('p' => 'projetos'));
        $select->columns(array(
                    'p_id' => 'id_proj',
                    'p_titulo' => 'titulo',
                ));

        $selectString = $sql->getSqlStringForSqlObject($select);
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        $selectData[''] = ':: Selecione um Projeto ::';
        foreach ($retorno as $res) {
            //$selectData[] = array('label' => 'Nenhum', 'options' => array($res['p_id'] => $res['p_titulo']));
            $selectData[$res['p_id']] = $res['p_titulo'];
        }
        //print_r($selectData);
        return $selectData;
    }
}
