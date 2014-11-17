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
        ));

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $date = new \DateTime($res['start_date']);
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
        $sql = new Sql($this->adapter);
        $select = new Select(array('l' => 'ligacoes'));
        $select->columns(array(
            'id_ligacao' => 'id_ligacao',
            'membro' => 'membro',
            'destinatario' => 'destinatario',
            'assunto' => 'assunto',
            'data_hora' => 'data_hora',
            'status_ligacao' => 'status_ligacao'
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
}
