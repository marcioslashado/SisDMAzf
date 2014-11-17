<?php

namespace Ligacoes\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Ligacoes implements InputFilterAwareInterface {

    protected $inputFilter;
    public $l_id;
    public $l_membro;
    public $l_destino;
    public $l_assunto;
    public $l_data;
    public $l_status;
    public $ll_id;
    public $ll_ligacao;
    public $ll_data;
    public $ll_duracao;
    public $ll_nota;

    /**
     * Para o Form
     */
    public $form_codigo;
    public $form_origem;
    public $form_destino;
    public $form_assunto;
    public $form_data;
    public $form_status;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data) {
        $this->l_id = (isset($data['l_id'])) ? $data['l_id'] : null;
        $this->l_membro = (isset($data['l_membro'])) ? $data['l_membro'] : null;
        $this->l_destino = (isset($data['l_destino'])) ? $data['l_destino'] : null;
        $this->l_assunto = (isset($data['l_assunto'])) ? $data['l_assunto'] : null;
        $this->l_data = (isset($data['l_data'])) ? $data['l_data'] : null;
        $this->l_status = (isset($data['l_status'])) ? $data['l_status'] : null;
        $this->ll_id = (isset($data['ll_id'])) ? $data['ll_id'] : null;
        $this->ll_ligacao = (isset($data['ll_ligacao'])) ? $data['ll_ligacao'] : null;
        $this->ll_data = (isset($data['ll_data'])) ? $data['ll_data'] : null;
        $this->ll_duracao = (isset($data['ll_duracao'])) ? $data['ll_duracao'] : null;
        $this->ll_nota = (isset($data['ll_nota'])) ? $data['ll_nota'] : null;
        
        /**
         * Registro de campos do Formulário
         * Necessários para a ação de CRUD
         */
        $this->form_codigo = (isset($data['l_id'])) ? $data['l_id'] : null;
        $this->form_origem = (isset($data['l_membro'])) ? $data['l_membro'] : null;
        $this->form_destino = (isset($data['l_destino'])) ? $data['l_destino'] : null;
        $this->form_assunto = (isset($data['l_assunto'])) ? $data['l_assunto'] : null;
        $this->form_data = (isset($data['l_data'])) ? $data['l_data'] : null;
        $this->form_status = (isset($data['l_status'])) ? $data['l_status'] : null;
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
