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
                    'cargocontato' => 'cargocontato'
                ))
                ->join(array('e' => 'contatos_emails'), 'e.id_contato = c.idcontatos', array(
                    'e_id' => 'id',
                    'e_detalhes' => new \Zend\Db\Sql\Expression("group_concat(DISTINCT(e.email), ' (', e.tipo_email, ')' SEPARATOR ' - ')"),
//                    'e_tipo' => 'tipo_email',
//                    'e_email' => 'email'
                        ), 'left')
                ->join(array('t' => 'contatos_telefones'), 't.id_contato = c.idcontatos', array(
                    't_id' => 'id',
                    't_detalhes' => new \Zend\Db\Sql\Expression("group_concat(DISTINCT(t.telefone), ' / ' , t.ramal,' (', t.tipo_fone, ')' SEPARATOR ' - ')"),
//                    't_tipo' => 'tipo_fone',
//                    't_tel' => 'telefone',
//                    't_ramal' => 'ramal'
                        ), 'left')
                ->group('c.idcontatos');
        //->where(array('e.projeto' => $proj_id, 'e.elemento' => $el_id, 'e.fonte' => $fonte_id));

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $selectData[] = $res; //retorna logo tudo
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
                ->where(array('c.idcontatos' => $id));

        //echo $select->getSqlString(); //Exibe a consulta em SQL
        $result = $this->selectWith($select);
        $row = $result->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function getFones($id) {
        $sql = new Sql($this->adapter);
        $this->table = array('t' => 'contatos_telefones');
        $select = new Select();
        $select->from(array('t' => 'contatos_telefones'));
        $select->columns(array(
                    't_id' => 'id',
                    't_tipo' => 'tipo_fone',
                    't_tel' => 'telefone',
                    't_ramal' => 'ramal'
                ))
                ->where(array('t.id_contato' => $id));
        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        if (!$retorno) {
            throw new \Exception("Could not find row $id");
        }
        $selectData = array();
        foreach ($retorno as $res) {
            $selectData[] = $res;
        }
        return $selectData;
    }

    public function getEmails($id) {
        $sql = new Sql($this->adapter);
        $this->table = array('e' => 'contatos_emails');
        $select = new Select();
        $select->from(array('e' => 'contatos_emails'));
        $select->columns(array(
                    'e_id' => 'id',
                    'e_id_contato' => 'id_contato',
                    'e_tipo' => 'tipo_email',
                    'e_email' => 'email'
                ))
                ->where(array('e.id_contato' => $id));
        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        if (!$retorno) {
            throw new \Exception("Could not find row $id");
        }
        $selectData = array();
        foreach ($retorno as $res) {
            $selectData[] = $res;
        }
        return $selectData;
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

        if ($id == 0) {
            $query = $sql->insert('contatos');
            $query->values($dados);
            $selectString = $sql->getSqlStringForSqlObject($query);
            $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

            $pega_id = $this->adapter->getDriver()->getConnection()->getLastGeneratedValue();

            if (count($form_telefone) > 0 AND count($form_email) > 0) {
                //Telefone
                foreach (array_map(NULL, $form_telefone, $form_ramal, $form_tipo_fone) as $x) {
                    list($form_telefone, $form_ramal, $form_tipo_fone) = $x;
                    //echo "$form_telefone $form_ramal $form_tipo_fone\n";
                    $telefones = array(
                        'id_contato' => $pega_id,
                        'tipo_fone' => $form_tipo_fone,
                        'telefone' => $form_telefone,
                        'ramal' => $form_ramal
                    );

                    $query2 = $sql->insert('contatos_telefones');
                    $query2->values($telefones);
                    $selectString2 = $sql->getSqlStringForSqlObject($query2);
                    $results_tel = $this->adapter->query($selectString2, Adapter::QUERY_MODE_EXECUTE);
                }
                foreach (array_map(NULL, $form_email, $form_tipo_email) as $x) {
                    list($form_email, $form_tipo_email) = $x;
                    $emails = array(
                        'id_contato' => $pega_id,
                        'tipo_email' => $form_tipo_email,
                        'email' => $form_email
                    );

                    $query3 = $sql->insert('contatos_emails');
                    $query3->values($emails);
                    $selectString3 = $sql->getSqlStringForSqlObject($query3);
                    $results_email = $this->adapter->query($selectString3, Adapter::QUERY_MODE_EXECUTE);
                }
                return $results_tel;
                return $results_email;
            }
        } 
        else {
            if ($this->getContato($id)) {
                $role = array(
                    'nomecontatos' => $form_nome,
                    'siglacontatos' => $form_sigla,
                    'orgaocontatos' => $form_orgao,
                    'enderecoorgao' => $form_endereco,
                    'cargocontato' => $form_cargo,
                );

                $query = $sql->update('contatos');
                $query->set($role);
                $query->where(array('idcontatos' => $id));
                $selectString = $sql->getSqlStringForSqlObject($query);
                $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

                $delete_emails = new TableGateway('contatos_emails', $this->adapter);
                $delete_emails->delete(array('id_contato' => $id));
                $delete_tels = new TableGateway('contatos_telefones', $this->adapter);
                $delete_tels->delete(array('id_contato' => $id));

                //Telefone
                foreach (array_map(NULL, $form_telefone, $form_ramal, $form_tipo_fone) as $x) {
                    list($form_telefone, $form_ramal, $form_tipo_fone) = $x;
                    //echo "$form_telefone $form_ramal $form_tipo_fone\n";
                    $telefones = array(
                        'id_contato' => $id,
                        'tipo_fone' => $form_tipo_fone,
                        'telefone' => $form_telefone,
                        'ramal' => $form_ramal
                    );

                    $query2 = $sql->insert('contatos_telefones');
                    $query2->values($telefones);
                    $selectString2 = $sql->getSqlStringForSqlObject($query2);
                    $results_tel = $this->adapter->query($selectString2, Adapter::QUERY_MODE_EXECUTE);
                }
                foreach (array_map(NULL, $form_email, $form_tipo_email) as $x) {
                    list($form_email, $form_tipo_email) = $x;
                    $emails = array(
                        'id_contato' => $id,
                        'tipo_email' => $form_tipo_email,
                        'email' => $form_email
                    );

                    $query3 = $sql->insert('contatos_emails');
                    $query3->values($emails);
                    $selectString3 = $sql->getSqlStringForSqlObject($query3);
                    $results_email = $this->adapter->query($selectString3, Adapter::QUERY_MODE_EXECUTE);
                }
                return $results_tel;
                return $results_email;
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteContato($id) {
        $contato = new TableGateway('contatos', $this->adapter);
        $contato->delete(array('idcontatos' => $id));
    }

}
