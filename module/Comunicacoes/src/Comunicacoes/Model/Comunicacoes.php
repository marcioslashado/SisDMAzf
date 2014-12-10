<?php

namespace Comunicacoes\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Comunicacoes implements InputFilterAwareInterface {

    protected $inputFilter;
    public $id_comunicacao;
    public $id_projeto;
    public $id_etapa;
    public $data;
    public $tipo_comunicacao;
    public $id_contato_rem;
    public $id_contato_dest;
    public $descricao;
    public $status;

    /**
     * Para o Form
     */
    public $form_codigo;
    public $form_origem;
    public $form_destino;
    public $form_assunto;
    public $form_data;
    public $form_status;
    public $form_tipo;
    public $form_projeto;
    public $form_etapas;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data) {
        $this->id_comunicacao = (isset($data['id_comunicacao'])) ? $data['id_comunicacao'] : null;
        $this->id_projeto = (isset($data['id_projeto'])) ? $data['id_projeto'] : null;
        $this->id_etapa = (isset($data['id_etapa'])) ? $data['id_etapa'] : null;
        $this->data = (isset($data['data'])) ? $data['data'] : null;
        $this->tipo_comunicacao = (isset($data['tipo_comunicacao'])) ? $data['tipo_comunicacao'] : null;
        $this->id_contato_rem = (isset($data['id_contato_rem'])) ? $data['id_contato_rem'] : null;
        $this->id_contato_dest = (isset($data['id_contato_dest'])) ? $data['id_contato_dest'] : null;
        $this->descricao = (isset($data['descricao'])) ? $data['descricao'] : null;
        $this->status = (isset($data['status'])) ? $data['status'] : null;
        
        /**
         * Registro de campos do Formulário
         * Necessários para a ação de CRUD
         */
        $this->form_codigo = (isset($data['id_comunicacao'])) ? $data['id_comunicacao'] : null;
        $this->form_origem = (isset($data['id_contato_rem'])) ? $data['id_contato_rem'] : null;
        $this->form_destino = (isset($data['id_contato_dest'])) ? $data['id_contato_dest'] : null;
        $this->form_assunto = (isset($data['descricao'])) ? $data['descricao'] : null;
        $this->form_data = (isset($data['data'])) ? $data['data'] : null;
        $this->form_status = (isset($data['status'])) ? $data['status'] : null;
        $this->form_tipo = (isset($data['tipo_comunicacao'])) ? $data['tipo_comunicacao'] : null;
        $this->form_projeto = (isset($data['id_projeto'])) ? $data['id_projeto'] : null;
        $this->form_etapas = (isset($data['id_etapa'])) ? $data['id_etapa'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_codigo',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_origem',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_destino',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_assunto',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_data',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_status',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_tipo',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_duracao',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_nota',
                        'required' => true
            )));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}
