<?php
namespace Contatos\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Db\Sql\Select; 

class ContatosForm extends Form {

    protected $adapter;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('contatos');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'form_codigo',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'form_nome',
            'attributes' => array(
                'type' => 'text',
                'id' => 'nome_contato',
                'class' => 'form-control input-sm',
                'placeholder' => 'Nome Sobrenome',
                'required' => 'required'
            ),
        ));
        
        $this->add(array(
            'name' => 'form_sigla',
            'attributes' => array(
                'type' => 'text',
                'id' => 'nome_sigla',
                'class' => 'form-control input-sm',
                'placeholder' => 'IPLANFOR, IFAN, etc'
            ),
        ));
        
        $this->add(array(
            'name' => 'form_orgao',
            'attributes' => array(
                'type' => 'text',
                'id' => 'form_orgao',
                'class' => 'form-control input-sm',
                'placeholder' => 'Nome do Orgão'
            ),
        ));
        
        $this->add(array(
            'name' => 'form_endereco',
            'attributes' => array(
                'type' => 'text',
                'id' => 'form_endereco',
                'class' => 'form-control input-sm',
                'placeholder' => 'Endereço completo do órgão'
            ),
        ));
        
        $this->add(array(
            'name' => 'form_cargo',
            'attributes' => array(
                'type' => 'text',
                'id' => 'nome_cargo',
                'class' => 'form-control input-sm',
                'placeholder' => 'Diretor, Gerente, etc'
            ),
        ));
        $this->add(array(
            'name' => 'form_telefone[]',
            'attributes' => array(
                'type' => 'text',
                'id' => 'nome_telefone',
                'class' => 'form-control input-sm',
                'placeholder' => '(99) 9999-9999', 
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'form_ramal[]',
            'attributes' => array(
                'type' => 'text',
                'id' => 'form_ramal',
                'class' => 'form-control input-sm',
                'placeholder' => '9999/9999/9999'
            ),
        ));
        $this->add(array(
            'name' => 'form_tipo_fone[]',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'form_tipo_fone',
                'class' => 'form-control input-sm',
                'Active' => 'Geral', //Mantém selecionado o valor '1'
            ),
            'options' => array(
                'value_options' => array(
                    'Institucional' => 'Institucional',
                    'Celular' => 'Celular',
                    'Geral' => 'Geral',
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'form_email[]',
            'attributes' => array(
                'type' => 'text',
                'id' => 'nome_email',
                'class' => 'form-control input-sm',
                'placeholder' => 'email@provedor.com', 
                'required' => 'required'
            ),
        ));
        $this->add(array(
            'name' => 'form_tipo_email[]',
            'attributes' => array(
                'type' => 'text',
                'id' => 'nome_email',
                'class' => 'form-control input-sm',
                'placeholder' => 'Ex.: Particular, Institucional, etc'
            ),
        ));
        
        $this->add(array(
            'name' => 'form_tipo_email[]',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'form_tipo_email',
                'class' => 'form-control input-sm',
                'Active' => 'Institucional', //Mantém selecionado o valor '1'
            ),
            'options' => array(
                'value_options' => array(
                    'Institucional' => 'Institucional',
                    'Pessoal' => 'Pessoal',
                    'Outro' => 'Outro',
                ),
            ),
        ));
        
        $this->add(array(
            new Element\Button('adicionar'),
            'name' => 'adicionar',
            'attributes' => array(
                'type' => 'submit',
                'id' => 'adicionar',
                'class' => 'btn btn-primary',
                'value' => '<span class="glyphicon" data-icon="&#xe1dc;"></span> Adicionar',
            ),
        ));
    }
}
