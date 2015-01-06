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

    //GAMBIARRA FEIA - DIA
    public function getAgendaDia(Select $select = null) {
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
        ))
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('MONTH(start_date) = ?', $date->format('m'))); //Seleciona por mês
        ->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('DAY(start_date) = ?', $date->format('d'))); //Seleciona por Dia
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('WEEK (start_date) = WEEK(current_date) AND YEAR(start_date) = YEAR(current_date)')); //Seleciona por semana
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('YEAR(start_date) = ?', $date->format('Y'))); //Seleciona por Ano

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $current_date = new \DateTime();
            $selectData[] = array(
                'id_agenda' => $res['id_agenda'],
                'start_date' => $res['start_date'],
                'end_date' => $res['end_date'],
                'text' => $res['text'],
                'details' => $res['details'],
                'convidados' => $this->getNomes($res['convidados']),
                'event_location' => $res['event_location']
            );
        }
        return $selectData;
    }

    //GAMBIARRA FEIA - SEMANA
    public function getAgendaSemana(Select $select = null) {
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
        ))
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('MONTH(start_date) = ?', $date->format('m'))); //Seleciona por mês
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('DAY(start_date) = ?', $date->format('d'))); //Seleciona por Dia
        ->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('WEEK (start_date) = WEEK(current_date) AND YEAR(start_date) = YEAR(current_date)')); //Seleciona por semana
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('YEAR(start_date) = ?', $date->format('Y'))); //Seleciona por Ano

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $current_date = new \DateTime();
            $selectData[] = array(
                'id_agenda' => $res['id_agenda'],
                'start_date' => $res['start_date'],
                'end_date' => $res['end_date'],
                'text' => $res['text'],
                'details' => $res['details'],
                'convidados' => $this->getNomes($res['convidados']),
                'event_location' => $res['event_location']
            );
        }
        return $selectData;
    }

    //GAMBIARRA FEIA - MES
    public function getAgendaMes(Select $select = null) {
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
        ))
        ->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('MONTH(start_date) = ?', $date->format('m'))); //Seleciona por mês
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('DAY(start_date) = ?', $date->format('d'))); //Seleciona por Dia
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('WEEK (start_date) = WEEK(current_date) AND YEAR(start_date) = YEAR(current_date)')); //Seleciona por semana
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('YEAR(start_date) = ?', $date->format('Y'))); //Seleciona por Ano

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $current_date = new \DateTime();
            $selectData[] = array(
                'id_agenda' => $res['id_agenda'],
                'start_date' => $res['start_date'],
                'end_date' => $res['end_date'],
                'text' => $res['text'],
                'details' => $res['details'],
                'convidados' => $this->getNomes($res['convidados']),
                'event_location' => $res['event_location']
            );
        }
        return $selectData;
    }

    public function getComunicacoesDia(Select $select = null) {
        $date = new \DateTime();
        $sql = new Sql($this->adapter);
        $select = new Select(array('c' => 'comunicacoes'));
        $select->columns(array(
                    'id_comunicacao' => 'id_comunicacao',
                    'id_projeto' => 'id_projeto',
                    'id_etapa' => 'id_etapa',
                    'data' => 'data',
                    'tipo_comunicacao' => 'tipo_comunicacao',
                    'id_contato_rem' => 'id_contato_rem',
                    'id_contato_dest' => 'id_contato_dest',
                    'descricao' => 'descricao',
                    'status' => 'status'
                ))
                ->join(array('r' => 'contatos'), 'r.idcontatos = c.id_contato_rem', array(
                    'r_idcontatos' => 'idcontatos',
                    'r_nome' => 'nomecontatos',
                        ), 'left')
                ->join(array('d' => 'contatos'), 'd.idcontatos = c.id_contato_dest', array(
                    'd_idcontatos' => 'idcontatos',
                    'd_nome' => 'nomecontatos',
                        ), 'left')
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('MONTH(data_hora) = ?', $date->format('m'))); //Seleciona por mês
        ->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('DAY(data) = ?', $date->format('d'))); //Seleciona por Dia
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('WEEK (data_hora) = WEEK(current_date) AND YEAR(data_hora) = YEAR(current_date)')); //Seleciona por Semana
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('YEAR(data_hora) = ?', $date->format('Y'))); //Seleciona por Ano

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $remetentes = $this->getNomes($res['id_contato_rem']);
            $destinatarios = $this->getNomes($res['id_contato_dest']);
            $selectData[] = array(
                'id_comunicacao' => $res['id_comunicacao'],
                'id_projeto' => $res['id_projeto'],
                'id_etapa' => $res['id_etapa'],
                'data' => $res['data'],
                'tipo_comunicacao' => $res['tipo_comunicacao'],
                'r_nome' => $remetentes,
                'd_nome' => $destinatarios,
                'descricao' => $res['descricao'],
                'status' => $res['status']
            );
        }
        return $selectData;
    }

    public function getComunicacoesSemana(Select $select = null) {
        $date = new \DateTime();
        $sql = new Sql($this->adapter);
        $select = new Select(array('c' => 'comunicacoes'));
        $select->columns(array(
                    'id_comunicacao' => 'id_comunicacao',
                    'id_projeto' => 'id_projeto',
                    'id_etapa' => 'id_etapa',
                    'data' => 'data',
                    'tipo_comunicacao' => 'tipo_comunicacao',
                    'id_contato_rem' => 'id_contato_rem',
                    'id_contato_dest' => 'id_contato_dest',
                    'descricao' => 'descricao',
                    'status' => 'status'
                ))
                ->join(array('r' => 'contatos'), 'r.idcontatos = c.id_contato_rem', array(
                    'r_idcontatos' => 'idcontatos',
                    'r_nome' => 'nomecontatos',
                        ), 'left')
                ->join(array('d' => 'contatos'), 'd.idcontatos = c.id_contato_dest', array(
                    'd_idcontatos' => 'idcontatos',
                    'd_nome' => 'nomecontatos',
                        ), 'left')
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('MONTH(data_hora) = ?', $date->format('m'))); //Seleciona por mês
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('DAY(data) = ?', $date->format('d'))); //Seleciona por Dia
        ->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('WEEK (data) = WEEK(current_date) AND YEAR(data) = YEAR(current_date)')); //Seleciona por Semana
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('YEAR(data_hora) = ?', $date->format('Y'))); //Seleciona por Ano

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $remetentes = $this->getNomes($res['id_contato_rem']);
            $destinatarios = $this->getNomes($res['id_contato_dest']);
            $selectData[] = array(
                'id_comunicacao' => $res['id_comunicacao'],
                'id_projeto' => $res['id_projeto'],
                'id_etapa' => $res['id_etapa'],
                'data' => $res['data'],
                'tipo_comunicacao' => $res['tipo_comunicacao'],
                'r_nome' => $remetentes,
                'd_nome' => $destinatarios,
                'descricao' => $res['descricao'],
                'status' => $res['status']
            );
        }
        return $selectData;
    }

    public function getComunicacoesMes(Select $select = null) {
        $date = new \DateTime();
        $sql = new Sql($this->adapter);
        $select = new Select(array('c' => 'comunicacoes'));
        $select->columns(array(
                    'id_comunicacao' => 'id_comunicacao',
                    'id_projeto' => 'id_projeto',
                    'id_etapa' => 'id_etapa',
                    'data' => 'data',
                    'tipo_comunicacao' => 'tipo_comunicacao',
                    'id_contato_rem' => 'id_contato_rem',
                    'id_contato_dest' => 'id_contato_dest',
                    'descricao' => 'descricao',
                    'status' => 'status'
                ))
        ->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('MONTH(data) = ?', $date->format('m'))); //Seleciona por mês
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('DAY(data) = ?', $date->format('d'))); //Seleciona por Dia
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('WEEK (data) = WEEK(current_date) AND YEAR(data_hora) = YEAR(current_date)')); //Seleciona por Semana
        //->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('YEAR(data) = ?', $date->format('Y'))); //Seleciona por Ano

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $remetentes = $this->getNomes($res['id_contato_rem']);
            $destinatarios = $this->getNomes($res['id_contato_dest']);
            $selectData[] = array(
                'id_comunicacao' => $res['id_comunicacao'],
                'id_projeto' => $res['id_projeto'],
                'id_etapa' => $res['id_etapa'],
                'data' => $res['data'],
                'tipo_comunicacao' => $res['tipo_comunicacao'],
                'r_nome' => $remetentes,
                'd_nome' => $destinatarios,
                'descricao' => $res['descricao'],
                'status' => $res['status']
            );
        }
        return $selectData;
    }
    
    public function getNomes($id) {
        $id = $id;
        $sql = new Sql($this->adapter);
        $this->table = array('ce' => 'contatos_emails');
        $select = new Select();
        $select->from(array('ce' => 'contatos_emails'));
        $select
                ->columns(array(
                    'id_email' => 'id',
                    'id_contato' => 'id_contato'
                ))
                ->join(array('c' => 'contatos'), 'c.idcontatos = ce.id_contato', array(
                    'c_id' => 'idcontatos',
                    'nomecontatos' => new \Zend\Db\Sql\Expression("group_concat(DISTINCT(c.nomecontatos) SEPARATOR '; ')"),
                        ), 'left')
                ->where('ce.id IN(' . $id . ')');

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $selectData = $res['nomecontatos'];
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
