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
        $id = $contato->form_codigo;
        $sql = new Sql($this->adapter);
        $data = array(
            'nomecontatos' => $contato->form_nome,
            'siglacontatos' => $contato->form_sigla,
            'cargocontato' => $contato->form_cargo,
            'telefone' => $contato->form_telefone,
            'ramalfone' => $contato->form_ramal,
            'celcontato' => $contato->form_celular,
            'emailcontato' => $contato->form_email,
        );
        if ($id == 0) {
            $query = $sql->insert('contatos');
            $query->values($data);
            $selectString = $sql->getSqlStringForSqlObject($query);
            $results = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
            return $results;
        } else {
            if ($this->getContato($id)) {
                $data = array(
                    'nomecontatos' => $contato->form_nome,
                    'siglacontatos' => $contato->form_sigla,
                    'cargocontato' => $contato->form_cargo,
                    'telefone' => $contato->form_telefone,
                    'ramalfone' => $contato->form_ramal,
                    'celcontato' => $contato->form_celular,
                    'emailcontato' => $contato->form_email,
                );
                $query2 = $sql->update('contatos');
                $query2->set($data);
                $query2->where(array('idcontatos' => $id));
                $selectString2 = $sql->getSqlStringForSqlObject($query2);
                $results = $this->adapter->query($selectString2, Adapter::QUERY_MODE_EXECUTE);
                return $results;
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
