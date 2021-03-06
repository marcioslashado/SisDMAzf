<?php

namespace Agenda\Model;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\View\Model\JsonModel;

class AgendaTable extends AbstractTableGateway {

    protected $table = 'agenda';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Agenda());

        $this->initialize();
    }

    public function getAgenda(Select $select = null) {
        $sql = new Sql($this->adapter);
        $select = new Select(array('e' => 'agenda'));
        $select->columns(array(
            'id_agenda' => 'id_agenda',
            'start_date' => 'start_date',
            'end_date' => 'end_date',
            'text' => 'text',
            'details' => 'details',
            'convidados' => 'convidados',
            'event_location' => 'event_location'
        ));
        //->where(array('e.projeto' => $proj_id, 'e.elemento' => $el_id, 'e.fonte' => $fonte_id));

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $selectData[] = array(
                'id' => $res['id_agenda'],
                'start_date' => $res['start_date'],
                'end_date' => $res['end_date'],
                'text' => $res['text'],
                'details' => $res['details'],
                'convidados' => $this->getNomes($res['convidados']),
                'event_location' => $res['event_location']
            );
        }
        return json_encode($selectData);
    }

    public function getCalendar($id) {
        $id = $id;
        $sql = new Sql($this->adapter);
        $this->table = array('a' => 'agenda');
        $select = new Select();
        $select->from(array('a' => 'agenda'));
        $select
                ->columns(array(
                    //'nome_renomeado' => 'nome_campo_db'
                    'a_id' => 'id_agenda',
                    'a_start' => 'start_date',
                    'a_end' => 'end_date',
                    'a_text' => 'text',
                    'a_details' => 'details',
                    'a_convidados' => 'convidados',
                    'a_location' => 'event_location',
                ))
                ->where(array('a.id_agenda' => $id));

        //echo $select->getSqlString(); //Exibe a consulta em SQL
        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $selectData[] = array(
                'a_id' => $res['a_id'],
                'a_start' => $res['a_start'],
                'a_end' => $res['a_end'],
                'a_text' => $res['a_text'],
                'a_details' => $res['a_details'],
                'a_convidados' => $this->getNomes($res['a_convidados']),
                'a_location' => $res['a_location']
            );
        }
        return $selectData;
    }
    
    public function getParticipantes($id) {
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
                    'nomecontatos' => 'nomecontatos'
                        ), 'left')
                ->where('ce.id IN(' . $id . ')');

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $selectData[] = $res;
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

    public function saveAgenda($calendar) {
        $id = $calendar['ids'];
        $count = strlen($id);
        $start = $calendar['start_date'];
        $end = $calendar['end_date'];
        $text = $calendar['text'];
        $details = $calendar['details'];
        $convidados = $calendar['convidados'];
        $location = $calendar['event_location'];
        $acao = $calendar['nativeeditor_status'];

        $sql = new Sql($this->adapter);
        $data = array(
            //'id_agenda' => $id,
            'start_date' => $start,
            'end_date' => $end,
            'text' => $text,
            'details' => $details,
            'convidados' => $convidados,
            'event_location' => $location,
        );
        if ($acao == 'inserted') {
            $query = $sql->insert('agenda');
            $query->values($data);
            $selectString = $sql->getSqlStringForSqlObject($query);
            $results = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
            return $results;
            echo "Agenda adicionada com Sucesso!";
        } elseif ($acao == 'updated') {
            if ($this->getCalendar($id)) {
                $data = array(
                    'id_agenda' => $id,
                    'start_date' => $start,
                    'end_date' => $end,
                    'text' => $text,
                    'details' => $details,
                    'convidados' => $convidados,
                    'event_location' => $location,
                );
                $query2 = $sql->update('agenda');
                $query2->set($data);
                $query2->where(array('id_agenda' => $id));
                $selectString2 = $sql->getSqlStringForSqlObject($query2);
                $results = $this->adapter->query($selectString2, Adapter::QUERY_MODE_EXECUTE);
                return $results;
                echo "Agenda atualizada com Sucesso!";
            } else {
                throw new \Exception('Form id does not exist');
            }
        } elseif ($acao == 'deleted') {
            $agenda = new TableGateway('agenda', $this->adapter);
            $agenda->delete(array('id_agenda' => $id));
            echo "Agenda excluída com Sucesso!";
        }
    }
}
