<?php

namespace Contatos\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Contatos implements InputFilterAwareInterface {

    protected $inputFilter;
    public $c_id;
    public $c_nome;
    public $c_sigla;
    public $c_orgao;
    public $c_endereco;
    public $c_cargo;
    public $e_id;
    public $e_tipo;
    public $e_email;
    public $t_id;
    public $t_tipo;
    public $t_tel;
    public $t_ramal;

    /**
     * Para o Form
     */
    public $form_codigo;
    public $form_nome;
    public $form_sigla;
    public $form_orgao;
    public $form_endereco;
    public $form_cargo;
    public $form_telefone;
    public $form_ramal;
    public $form_tipo_fone;
    public $form_email;
    public $form_tipo_email;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data) {
        $this->c_id = (isset($data['idcontatos'])) ? $data['idcontatos'] : null;
        $this->c_nome = (isset($data['nomecontatos'])) ? $data['nomecontatos'] : null;
        $this->c_sigla = (isset($data['siglacontatos'])) ? $data['siglacontatos'] : null;
        $this->c_orgao = (isset($data['orgaocontatos'])) ? $data['orgaocontatos'] : null;
        $this->c_endereco = (isset($data['enderecoorgao'])) ? $data['enderecoorgao'] : null;
        $this->c_cargo = (isset($data['cargocontato'])) ? $data['cargocontato'] : null;
        $this->e_id = (isset($data['e_id'])) ? $data['e_id'] : null;
        $this->e_tipo = (isset($data['e_tipo'])) ? $data['e_tipo'] : null;
        $this->e_email = (isset($data['e_email'])) ? $data['e_email'] : null;
        $this->t_id = (isset($data['t_id'])) ? $data['t_id'] : null;
        $this->t_tipo = (isset($data['t_tipo'])) ? $data['t_tipo'] : null;
        $this->t_tel = (isset($data['t_tel'])) ? $data['t_tel'] : null;
        $this->t_ramal = (isset($data['t_ramal'])) ? $data['t_ramal'] : null;

        /**
         * Registro de campos do Formulário
         * Necessários para a ação de CRUD
         */
        $this->form_codigo = (isset($data['idcontatos'])) ? $data['idcontatos'] : null;
        $this->form_nome = (isset($data['nomecontatos'])) ? $data['nomecontatos'] : null;
        $this->form_sigla = (isset($data['siglacontatos'])) ? $data['siglacontatos'] : null;
        $this->form_orgao = (isset($data['orgaocontatos'])) ? $data['orgaocontatos'] : null;
        $this->form_endereco = (isset($data['enderecoorgao'])) ? $data['enderecoorgao'] : null;
        $this->form_cargo = (isset($data['cargocontato'])) ? $data['cargocontato'] : null;
        $this->form_telefone = (isset($data['t_tel'])) ? $data['t_tel'] : null;
        $this->form_tipo_fone = (isset($data['t_tipo'])) ? $data['t_tipo'] : null;
        $this->form_ramal = (isset($data['t_ramal'])) ? $data['t_ramal'] : null;
        $this->form_tipo_email = (isset($data['e_tipo'])) ? $data['e_tipo'] : null;
        $this->form_email = (isset($data['e_email'])) ? $data['e_email'] : null;
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
                        'name' => 'form_nome',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_sigla',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_orgao',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_endereco',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_cargo',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_telefone[]',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_ramal[]',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_tipo_fone[]',
                        'required' => false
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_email[]',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_tipo_email[]',
                        'required' => false
            )));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

}
