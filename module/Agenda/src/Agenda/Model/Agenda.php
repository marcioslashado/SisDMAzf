<?php

namespace Agenda\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Agenda implements InputFilterAwareInterface {

    protected $inputFilter;

    /**
     * Used by ResultSet to pass each database row to the entity
     */
    public function exchangeArray($data) {
        /**
         * Registro de campos do Formulário
         * Necessários para a ação de CRUD
         */
        $this->form_codigo = (isset($data['a_id'])) ? $data['a_id'] : null;
        $this->a_id = (isset($data['a_id'])) ? $data['a_id'] : null;
        $this->a_start = (isset($data['a_start'])) ? $data['a_start'] : null;
        $this->a_end = (isset($data['a_end'])) ? $data['a_end'] : null;
        $this->a_text = (isset($data['a_text'])) ? $data['a_text'] : null;
        $this->a_details = (isset($data['a_details'])) ? $data['a_details'] : null;
        $this->a_convidados = (isset($data['a_convidados'])) ? $data['a_convidados'] : null;
        $this->a_location = (isset($data['a_location'])) ? $data['a_location'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'form_codigo',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));


            $this->inputFilter = $inputFilter;        
        }
        return $this->inputFilter;
    }

}
