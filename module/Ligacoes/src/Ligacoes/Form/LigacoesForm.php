<?php
namespace Ligacoes\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Db\Sql\Select; 

class LigacoesForm extends Form {

    protected $adapter;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('ligacoes');

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
                'class' => 'form-control input-sm',
                'required' => 'required',
            'value' => '', //Mantém selecionado o valor '1'
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
    }
}
