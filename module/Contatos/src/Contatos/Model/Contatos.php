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
    public $c_cargo;
    public $c_fone;
    public $c_ramal;
    public $c_celular;
    public $c_email;

    /**
     * Para o Form
     */
    public $form_codigo;
    public $form_nome;
    public $form_sigla;
    public $form_cargo;
    public $form_telefone;
    public $form_ramal;
    public $form_celular;
    public $form_email;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data) {
        $this->c_id = (isset($data['c_id'])) ? $data['c_id'] : null;
        $this->c_nome = (isset($data['c_nome'])) ? $data['c_nome'] : null;
        $this->c_sigla = (isset($data['c_sigla'])) ? $data['c_sigla'] : null;
        $this->c_cargo = (isset($data['c_cargo'])) ? $data['c_cargo'] : null;
        $this->c_fone = (isset($data['c_fone'])) ? $data['c_fone'] : null;
        $this->c_ramal = (isset($data['c_ramal'])) ? $data['c_ramal'] : null;
        $this->c_celular = (isset($data['c_celular'])) ? $data['c_celular'] : null;
        $this->c_email = (isset($data['c_email'])) ? $data['c_email'] : null;
        /**
         * Registro de campos do Formulário
         * Necessários para a ação de CRUD
         */
        $this->form_codigo = (isset($data['c_id'])) ? $data['c_id'] : null;
        $this->form_nome = (isset($data['c_nome'])) ? $data['c_nome'] : null;
        $this->form_sigla = (isset($data['c_sigla'])) ? $data['c_sigla'] : null;
        $this->form_cargo = (isset($data['c_cargo'])) ? $data['c_cargo'] : null;
        $this->form_telefone = (isset($data['c_fone'])) ? $data['c_fone'] : null;
        $this->form_ramal = (isset($data['c_ramal'])) ? $data['c_ramal'] : null;
        $this->form_celular = (isset($data['c_celular'])) ? $data['c_celular'] : null;
        $this->form_email = (isset($data['c_email'])) ? $data['c_email'] : null;
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
                        'name' => 'form_cargo',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_telefone',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_ramal',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_celular',
                        'required' => true
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'form_email',
                        'required' => true
            )));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

}
