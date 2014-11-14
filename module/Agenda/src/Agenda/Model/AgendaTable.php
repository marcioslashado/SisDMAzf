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
                'convidados' => $res['convidados'],
                'event_location' => $res['event_location']
            );
        }
        return json_encode($selectData);
    }

}
