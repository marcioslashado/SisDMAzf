<?php

namespace Home\Model;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\View\Model\JsonModel;

class HomeTable extends AbstractTableGateway {

    protected $table = 'agenda';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Home());

        $this->initialize();
    }

    public function getAgenda(Select $select = null) {
        $date = new \DateTime();
        $sql = new Sql($this->adapter);
        $select = new Select(array('a' => 'agenda'));
        $select->columns(array(
            'id_agenda' => 'id_agenda',
            'start_date' => 'start_date',
            'end_date' => 'end_date',
            'text' => 'text',
            'details' => 'details',
            'convidados' => 'convidados',
            'event_location' => 'event_location'
        ))->where(array(
            new \Zend\Db\Sql\Predicate\Operator('start_date', '>=', $date->format('Y-m-d').' 00:00:00'), 
            new \Zend\Db\Sql\Predicate\Operator('start_date', '<=', $date->format('Y-m-d').' 23:59:59'),
        ));

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $date = new \DateTime($res['start_date']);
            $current_date = new \DateTime();
            $selectData[] = array(
                'id' => $res['id_agenda'],
                'start_date' => $date->format('d/m/Y \à\s H:i'),
                'end_date' => $res['end_date'],
                'text' => $res['text'],
                'details' => $res['details'],
                'convidados' => $res['convidados'],
                'event_location' => $res['event_location']
            );
        }
        return $selectData;
    }

    public function getLigacoes(Select $select = null) {
        $date = new \DateTime();
        $sql = new Sql($this->adapter);
        $select = new Select(array('l' => 'ligacoes'));
        $select->columns(array(
            'id_ligacao' => 'id_ligacao',
            'membro' => 'membro',
            'destinatario' => 'destinatario',
            'assunto' => 'assunto',
            'data_hora' => 'data_hora',
            'status_ligacao' => 'status_ligacao'
        ))->where(array(
            new \Zend\Db\Sql\Predicate\Operator('data_hora', '>=', $date->format('Y-m-d').' 00:00:00'), 
            new \Zend\Db\Sql\Predicate\Operator('data_hora', '<=', $date->format('Y-m-d').' 23:59:59'),
        ));

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $date = new \DateTime($res['data_hora']);
            $selectData[] = array(
                'id_ligacao' => $res['id_ligacao'],
                'membro' => $res['membro'],
                'destinatario' => $res['destinatario'],
                'assunto' => $res['assunto'],
                'status_ligacao' => $res['status_ligacao'],
                'data_hora' => $date->format('d/m/Y \à\s H:i')
            );
        }
        return $selectData;
    }

    public function getUsers(Select $select = null) {
        $sql = new Sql($this->adapter);
        $select = new Select(array('u' => 'users'));
        $select->columns(array(
            'u_id' => 'id',
            'u_nome' => 'first_name',
            'u_sobrenome' => 'last_name',
            'u_status' => 'status'
        ));

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $selectData[] = array(
                'id' => $res['u_id'],
                'nome' => $res['u_nome'],
                'sobrenome' => $res['u_sobrenome'],
                'status' => $res['u_status']
            );
        }
        return $selectData;
    }

    public function updateUser($user) {
        $sql = new Sql($this->adapter);
        $id = $user->userId;
        $status = $user->status;
        if ($status == 'true') {
            $data = array(
                'id' => $id,
                'status' => 'Active',
            );
        } else {
            $data = array(
                'id' => $id,
                'status' => 'Inactive',
            );
        }
        $query2 = $sql->update('users');
        $query2->set($data);
        $query2->where(array('id' => $id));
        $selectString2 = $sql->getSqlStringForSqlObject($query2);
        $results = $this->adapter->query($selectString2, Adapter::QUERY_MODE_EXECUTE);
        return $results;
    }
}
