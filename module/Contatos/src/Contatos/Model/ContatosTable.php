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
        $select = new Select(array('e' => 'contatos'));
        $select->columns(array(
                    'idcontatos' => 'idcontatos',
                    'nomecontatos' => 'nomecontatos',
                    'siglacontatos' => 'siglacontatos',
                    'orgaocontatos' => 'orgaocontatos',
                    'enderecoorgao' => 'enderecoorgao',
                    'telefone' => 'telefone',
                    'ramalfone' => 'ramalfone',
                    'emailcontato' => 'emailcontato',
                    'celcontato' => 'celcontato',
                    'cargocontato' => 'cargocontato'
                ));
                //->where(array('e.projeto' => $proj_id, 'e.elemento' => $el_id, 'e.fonte' => $fonte_id));

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $selectData[] = array(
                'id_contato' => $res['idcontatos'],
                'nome_completo' => $res['nomecontatos'],
                'o_sigla' => $res['siglacontatos'],
                'o_nome' => $res['orgaocontatos'],
                'o_endereco' => $res['enderecoorgao'],
                'fone' => $res['telefone'],
                'ramal' => $res['ramalfone'],
                'email' => $res['emailcontato'],
                'celular' => $res['celcontato'],
                'cargo' => $res['cargocontato']
            );
        }
        return json_encode($selectData);
    }

}
