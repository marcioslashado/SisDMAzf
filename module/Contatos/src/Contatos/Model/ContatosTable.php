<?php

namespace Contatos\Model;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\View\Model\JsonModel;

class ContatosTable extends AbstractTableGateway {

    protected $table = 'contatos';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Contatos());

        $this->initialize();
    }

    public function getContatos(Select $select = null) {
        $sql = new Sql($this->adapter);
        $select = new Select(array('c' => 'contatos'));
        $select->columns(array(
                    'idcontatos' => 'idcontatos',
                    'nomecontatos' => 'nomecontatos',
                    'siglacontatos' => 'siglacontatos',
                    'orgaocontatos' => 'orgaocontatos',
                    'enderecoorgao' => 'enderecoorgao',
                    'enderecoorgao' => 'enderecoorgao',
                    'cargocontato' => 'cargocontato'
                ))
                ->join(array('e' => 'contatos_emails'), 'e.id_contato = c.idcontatos', array(
                    'e_id' => 'id',
                    'e_tipo' => 'tipo_email',
                    'e_email' => 'email'
                ), 'left')
                ->join(array('t' => 'contatos_telefones'), 't.id_contato = c.idcontatos', array(
                    't_id' => 'id',
                    't_tipo' => 'tipo_fone',
                    't_tel' => 'telefone',
                    't_ramal' => 'ramal'
                ), 'left');
        //->where(array('e.projeto' => $proj_id, 'e.elemento' => $el_id, 'e.fonte' => $fonte_id));

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
              $selectData[] = $res; //retorna logo tudo
              
//            $selectData[] = array(
//                'id_contato' => $res['idcontatos'],
//                'nome_completo' => $res['nomecontatos'],
//                'o_sigla' => $res['siglacontatos'],
//                'o_nome' => $res['orgaocontatos'],
//                'o_endereco' => $res['enderecoorgao'],
//                'fone' => $res['telefone'],
//                'ramal' => $res['ramalfone'],
//                'email' => $res['emailcontato'],
//                'celular' => $res['celcontato'],
//                'cargo' => $res['cargocontato']
//            );
        }
        return json_encode($selectData);
    }

    public function getContato($id) {
        $this->table = array('c' => 'contatos');
        $select = new Select();
        $select->from(array('c' => 'contatos'));
        $select->columns(array(
                    'idcontatos' => 'idcontatos',
                    'nomecontatos' => 'nomecontatos',
                    'siglacontatos' => 'siglacontatos',
                    'orgaocontatos' => 'orgaocontatos',
                    'enderecoorgao' => 'enderecoorgao',
                    'enderecoorgao' => 'enderecoorgao',
                    'cargocontato' => 'cargocontato'
                ))
                ->join(array('e' => 'contatos_emails'), 'e.id_contato = c.idcontatos', array(
                    'e_id' => 'id',
                    'e_tipo' => 'tipo_email',
                    'e_email' => 'email'
                ), 'left')
                ->join(array('t' => 'contatos_telefones'), 't.id_contato = c.idcontatos', array(
                    't_id' => 'id',
                    't_tipo' => 'tipo_fone',
                    't_tel' => 'telefone',
                    't_ramal' => 'ramal'
                ), 'left')
                ->where(array('c.idcontatos' => $id));

        //echo $select->getSqlString(); //Exibe a consulta em SQL
        $result = $this->selectWith($select);
        $row = $result->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveContato($contato) {
        $sql = new Sql($this->adapter);
        $id = $contato->form_codigo; //ID para edição caso exista. Vazio para a ação ADD
        $form_nome = $contato->form_nome;
        $form_sigla = $contato->form_sigla;
        $form_orgao = $contato->form_orgao;
        $form_endereco = $contato->form_endereco;
        $form_cargo = $contato->form_cargo;
        $form_telefone = $contato->form_telefone;
        $form_tipo_fone = $contato->form_tipo_fone;
        $form_ramal = $contato->form_ramal;
        $form_tipo_email = $contato->form_tipo_email;
        $form_email = $contato->form_email;
        
        $dados = array(
            'nomecontatos' => $form_nome,
            'siglacontatos' => $form_sigla,
            'orgaocontatos' => $form_orgao,
            'enderecoorgao' => $form_endereco,
            'cargocontato' => $form_cargo,
        );
        
        //$result = array_merge($form_telefone, $form_ramal, $form_tipo_fone);
        $result = array('telefone' => $form_telefone, 'Ramal' => $form_ramal, 'Tipo' => $form_tipo_fone);
        print_r($result);
        
//        if ($id == 0) {
//            $query = $sql->insert('contatos');
//            $query->values($dados);
//            $selectString = $sql->getSqlStringForSqlObject($query);
//            $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
//
//            $pega_id = $this->adapter->getDriver()->getConnection()->getLastGeneratedValue();
//
//            if (count($form_telefone) > 0) {
//                foreach ($form_telefone as $k => $v) {
//                    $data_arr = array(
//                        'role_id' => $pega_id,
//                        'permission_nome' => $v,
//                    );
//                    $query2 = $sql->insert('role_permission');
//                    $query2->values($data_arr);
//                    $selectString2 = $sql->getSqlStringForSqlObject($query2);
//                    $results = $this->adapter->query($selectString2, Adapter::QUERY_MODE_EXECUTE);
//                }
//                return $results;
//            }
//        } else {
//            if ($this->getPermissions($id)) {
//                $role = array(
//                    'rid' => $id,
//                    'role_name' => $grupo_titulo,
//                    'status' => $grupo_status,
//                );
//                
//                $query = $sql->update('role');
//                $query->set($role);
//                $query->where(array('rid' => $id));
//                $selectString = $sql->getSqlStringForSqlObject($query);
//                $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
//
//                $delete = new TableGateway('role_permission', $this->adapter);
//                $delete->delete(array('role_id' => $id));
//                
//                foreach ($grupo_modulo as $k => $v) {
//                    $data_arr = array(
//                        'role_id' => $id,
//                        'permission_nome' => $v,
//                    );
//                    $query2 = $sql->insert('role_permission');
//                    $query2->values($data_arr);
//                    $selectString2 = $sql->getSqlStringForSqlObject($query2);
//                    $results = $this->adapter->query($selectString2, Adapter::QUERY_MODE_EXECUTE);
//                }
//                return $results;
//            } else {
//                throw new \Exception('Form id does not exist');
//            }
//        }
    }

    public function deleteContato($id) {
        $contato = new TableGateway('contatos', $this->adapter);
        $contato->delete(array('idcontatos' => $id));
    }

}
