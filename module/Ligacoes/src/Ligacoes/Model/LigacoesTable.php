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

}
