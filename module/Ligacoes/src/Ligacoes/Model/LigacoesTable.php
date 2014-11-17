<?php

namespace Ligacoes\Model;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\View\Model\JsonModel;

class LigacoesTable extends AbstractTableGateway {

    protected $table = 'ligacoes';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Ligacoes());

        $this->initialize();
    }

    public function getLigacoes(Select $select = null) {
        $sql = new Sql($this->adapter);
        $select = new Select(array('e' => 'ligacoes'));
        $select->columns(array(
            'id_ligacao' => 'id_ligacao',
            'membro' => 'membro',
            'destinatario' => 'destinatario',
            'assunto' => 'assunto',
            'data_hora' => 'data_hora',
            'status_ligacao' => 'status_ligacao'
        ));
        //->where(array('e.projeto' => $proj_id, 'e.elemento' => $el_id, 'e.fonte' => $fonte_id));

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $date = new \DateTime($res['data_hora']);
            $dataAtual = $date->format('d/m/Y à\s H:i');
            $selectData[] = array(
                'id_ligacao' => $res['id_ligacao'],
                'membro' => $res['membro'],
                'destinatario' => $res['destinatario'],
                'assunto' => $res['assunto'],
                'data_hora' => $dataAtual,
                'status_ligacao' => $res['status_ligacao']
            );
        }
        return json_encode($selectData);
    }

    public function getLigacao($id) {
        $this->table = array('l' => 'ligacoes');
        $select = new Select();
        $select->from(array('l' => 'ligacoes'));
        $select
                ->columns(array(
                    //'nome_renomeado' => 'nome_campo_db'
                    'l_id' => 'id_ligacao',
                    'l_membro' => 'membro',
                    'l_destino' => 'destinatario',
                    'l_assunto' => 'assunto',
                    'l_data' => 'data_hora',
                    'l_status' => 'status_ligacao',
                ))
                ->where(array('l.id_ligacao' => $id));

        //echo $select->getSqlString(); //Exibe a consulta em SQL
        $result = $this->selectWith($select);
        $row = $result->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function getDetalhes($id) {
        $sql = new Sql($this->adapter);
        $this->table = array('ll' => 'ligacoes_log');
        $select = new Select();
        $select->from(array('ll' => 'ligacoes_log'));
        $select
                ->columns(array(
                    'll_id' => 'id_log',
                    'll_ligacao' => 'id_ligacao',
                    'll_data' => 'data_log',
                    'll_duracao' => 'duracao',
                    'll_nota' => 'nota',
                ))
                ->where(array('ll.id_ligacao' => $id));

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $date = new \DateTime($res['ll_data']);
            $dataAtual = $date->format('d/m/Y à\s H:i');
            $selectData[] = array(
                'll_id' => $res['ll_id'],
                'll_ligacao' => $res['ll_ligacao'],
                'll_data' => $dataAtual,
                'll_duracao' => $res['ll_duracao'],
                'll_nota' => $res['ll_nota'],
            );
        }
        return $selectData;
    }

    public function saveLigacao($ligacao) {
        $id = $ligacao->form_codigo;
        $sql = new Sql($this->adapter);
        $data = array(
            'membro' => $ligacao->form_origem,
            'destinatario' => $ligacao->form_destino,
            'assunto' => $ligacao->form_assunto,
            'data_hora' => $ligacao->form_data,
            'status_ligacao' => 'Pendente',
        );
        if ($id == 0) {
            $query = $sql->insert('ligacoes');
            $query->values($data);
            $selectString = $sql->getSqlStringForSqlObject($query);
            $results = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
            return $results;
        } else {
            if ($this->getLigacao($id)) {
                $data = array(
                    'membro' => $ligacao->form_origem,
                    'destinatario' => $ligacao->form_destino,
                    'assunto' => $ligacao->form_assunto,
                    'data_hora' => $ligacao->form_data,
                    'status_ligacao' => 'Pendente',
                );
                $query2 = $sql->update('ligacoes');
                $query2->set($data);
                $query2->where(array('id_ligacao' => $id));
                $selectString2 = $sql->getSqlStringForSqlObject($query2);
                $results = $this->adapter->query($selectString2, Adapter::QUERY_MODE_EXECUTE);
                return $results;
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function saveAnotacao($ligacao) {
        $date = new \DateTime();
        $dataAtual = $date->format('Y-m-d H:i:s');
        $id = $ligacao->form_codigo;
        $sql = new Sql($this->adapter);
        $data = array(
            'id_ligacao' => $id,
            'data_log' => $dataAtual,
            'duracao' => $ligacao->form_duracao,
            'nota' => $ligacao->form_nota,
        );

        $query = $sql->insert('ligacoes_log');
        $query->values($data);
        $selectString = $sql->getSqlStringForSqlObject($query);
        $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

        $data2 = array(
            'status_ligacao' => $ligacao->form_status,
        );
        
        $query2 = $sql->update('ligacoes');
        $query2->set($data2);
        $query2->where(array('id_ligacao' => $id));
        $selectString2 = $sql->getSqlStringForSqlObject($query2);
        $results = $this->adapter->query($selectString2, Adapter::QUERY_MODE_EXECUTE);
        return $results;
    }

    public function deleteLigacao($id) {
        $ligacao = new TableGateway('ligacoes', $this->adapter);
        $ligacao->delete(array('id_ligacao' => $id));
    }

}
