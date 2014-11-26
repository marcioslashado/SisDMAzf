<?php

namespace Comunicacoes\Model;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\View\Model\JsonModel;

class ComunicacoesTable extends AbstractTableGateway {

    protected $table = 'comunicacoes';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Comunicacoes());

        $this->initialize();
    }

    public function getComunicacoes(Select $select = null) {
        $sql = new Sql($this->adapter);
        $select = new Select(array('c' => 'comunicacoes'));
        $select->columns(array(
                    'id_comunicacao' => 'id_comunicacao',
                    'id_projeto_com' => 'id_projeto',
                    'id_etapa_com' => 'id_etapa',
                    'data_comunicacao' => 'data',
                    'tipo_comunicacao' => 'tipo_comunicacao',
                    'id_contato_rem' => 'id_contato_rem',
                    'id_contato_dest' => 'id_contato_dest',
                    'descricao_comunicacao' => 'descricao',
                    'status_comunicacao' => 'status'
                ))
                ->join(array('r' => 'contatos'), 'r.idcontatos = c.id_contato_rem', array(
                    'r_nome' => 'nomecontatos',
                    'r_sigla' => 'siglacontatos'
                ))
                ->join(array('d' => 'contatos'), 'd.idcontatos = c.id_contato_dest', array(
                    'd_nome' => 'nomecontatos',
                    'd_sigla' => 'siglacontatos'
                ))
                ->join(array('p' => 'projetos'), 'p.id_proj = c.id_projeto', array(
                    'p_id' => 'id_proj',
                    'p_desc' => 'titulo'
                        ), 'left')
                ->join(array('e' => 'etapas_projeto'), 'e.id_etapa = p.id_proj', array(
                    'e_id' => 'id_etapa',
                    'e_desc' => 'titulo_etapa'
                        ), 'left');
        //->where(array('e.projeto' => $proj_id, 'e.elemento' => $el_id, 'e.fonte' => $fonte_id));

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        foreach ($retorno as $res) {
            $date = new \DateTime($res['data_comunicacao']);
            $dataAtual = $date->format('d/m/Y à\s H:i');
            $selectData[] = array(
                'id_comunicacao' => $res['id_comunicacao'],
                'projeto' => $res['p_desc'],
                'etapa' => $res['e_desc'],
                'data_comunicacao' => $dataAtual,
                'tipo_comunicacao' => $res['tipo_comunicacao'],
                'remetente' => $res['r_nome'],
                'destinatario' => $res['d_nome'],
                'descricao_comunicacao' => $res['descricao_comunicacao'],
                'status_comunicacao' => $res['status_comunicacao']
            );
        }
        return json_encode($selectData);
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

    public function saveComunicacao($comunicacao) {
        $id = $comunicacao->form_codigo;
        $sql = new Sql($this->adapter);
        $data = array(
            'id_projeto' => $comunicacao->form_projeto,
            'id_etapa' => $comunicacao->form_etapas,
            'data' => $comunicacao->form_data,
            'tipo_comunicacao' => $comunicacao->form_tipo,
            'id_contato_rem' => $comunicacao->form_origem,
            'id_contato_dest' => $comunicacao->form_destino,
            'descricao' => $comunicacao->form_assunto,
            'status' => $comunicacao->form_status
        );
        if ($id == 0) {
            $query = $sql->insert('comunicacoes');
            $query->values($data);
            $selectString = $sql->getSqlStringForSqlObject($query);
            $results = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
            return $results;
        } else {
            if ($this->getComunicacao($id)) {
                $data = array(
                    'id_projeto' => $comunicacao->form_projeto,
                    'id_etapa' => $comunicacao->form_etapas,
                    'data' => $comunicacao->form_data,
                    'tipo_comunicacao' => $comunicacao->form_tipo,
                    'id_contato_rem' => $comunicacao->form_origem,
                    'id_contato_dest' => $comunicacao->form_destino,
                    'descricao' => $comunicacao->form_assunto,
                    'status' => $comunicacao->form_status
                );
                $query2 = $sql->update('comunicacoes');
                $query2->set($data);
                $query2->where(array('id_comunicacao' => $id));
                $selectString2 = $sql->getSqlStringForSqlObject($query2);
                $results = $this->adapter->query($selectString2, Adapter::QUERY_MODE_EXECUTE);
                return $results;
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function getComunicacao($id) {
        $this->table = array('c' => 'comunicacoes');
        $select = new Select();
        $select->from(array('c' => 'comunicacoes'));
        $select
                ->columns(array(
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
                ->where(array('c.id_comunicacao' => $id));

        //echo $select->getSqlString(); //Exibe a consulta em SQL
        $result = $this->selectWith($select);
        $row = $result->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveAnotacao($comunicacao) {
        $date = new \DateTime();
        $dataAtual = $date->format('Y-m-d H:i:s');
        $id = $comunicacao->form_codigo;
        $sql = new Sql($this->adapter);
        $data = array(
            'id_ligacao' => $id,
            'data_log' => $dataAtual,
            'duracao' => $comunicacao->form_duracao,
            'nota' => $comunicacao->form_nota,
        );

        $query = $sql->insert('comunicacoes_log');
        $query->values($data);
        $selectString = $sql->getSqlStringForSqlObject($query);
        $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

        $data2 = array(
            'status_ligacao' => $comunicacao->form_status,
        );

        $query2 = $sql->update('ligacoes');
        $query2->set($data2);
        $query2->where(array('id_ligacao' => $id));
        $selectString2 = $sql->getSqlStringForSqlObject($query2);
        $results = $this->adapter->query($selectString2, Adapter::QUERY_MODE_EXECUTE);
        return $results;
    }

    public function deleteComunicacao($id) {
        $comunicacao = new TableGateway('comunicacoes', $this->adapter);
        $comunicacao->delete(array('id_ligacao' => $id));
    }

    public function getEtapas($id) {
        $id = $id;
        $sql = new Sql($this->adapter);
        $select = new Select(array('e' => 'etapas_projeto'));
        $select->columns(array(
                    'id_etapa' => 'id_etapa',
                    'id_projeto' => 'id_projeto',
                    'titulo_etapa' => 'titulo_etapa',
                    'data_inicio' => 'data_inicio',
                    'data_termino' => 'data_termino',
                    'descricao' => 'descricao',
                    'status' => 'status'
                ))
                ->where(array('e.id_projeto' => $id));

        $selectString = $sql->getSqlStringForSqlObject($select);
        //echo $select->getSqlString();
        $retorno = $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $selectData = array();
        $selectData[] = array('valor' => '', 'label' => ':: Selecione um Projeto ::');
        foreach ($retorno as $res) {
            $selectData[] = array('valor' => $res['id_etapa'], 'label' => $res['titulo_etapa']);
        }
        return new JsonModel($selectData);
    }

}
