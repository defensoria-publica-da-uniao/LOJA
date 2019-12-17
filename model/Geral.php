<?php

require_once 'Banco.php';

class Geral extends Banco {

    // -----------------------------------[ Operações Genéricas ]----------------------------------- //
    // ----------------------------[ SELECT , INSERT , DELETE , UPDATE ]---------------------------- //

    /*
     * Listando registros
     */
    public function select2($tabela, $condicao = null, $order = null) {
        $this->sql = " SELECT * FROM {$tabela}";
        if (!empty($condicao))
            $this->sql .= ' ' . $condicao;
        if (!empty($order))
            $this->sql .= " ORDER BY $order";
        //echo'<pre>';                var_dump($this->sql); exit;
        //exit();
        return $this->query();
    }

    /*
     * Inserindo registros
     */
    public function insert2($tabela, $campos, $valores) {
        $this->sql = "INSERT INTO $tabela ($campos) VALUES ($valores)";
        // var_dump(  $this->sql);
        return $this->query();
    }

    /*
     * Deleta registro de um id especifico
     */
    public function delete2($tabela, $campo, $id) {
        $this->sql = " DELETE FROM $tabela WHERE $campo = '$id'";
        return $this->query();
    }

    /*
     * Deleta registro de um id especifico
     */
    public function updateMatInd($tabela, $status, $id) {
        (($status == 'A') ? $situacao = 'D' : $situacao = 'A');
        $campo = str_replace('tb_', '', $tabela);
        $this->sql = " UPDATE $tabela SET str_situacao = '{$situacao}' WHERE id_{$campo} = '$id'";
        return $this->query();
    }

    /*
     * Update
     */
    public function update2($tabela, $campos, $condicao, $resucondicao) {
        $this->sql = "UPDATE $tabela SET $campos WHERE $condicao = $resucondicao";
        //var_dump($this->sql);
        return $this->query();
    }

    // --------------[ FIM ]--------------[ Operações Genéricas ]--------------[ FIM ]-------------- //
    // --------------[ FIM ]-------[ SELECT , INSERT , DELETE , UPDATE ]-------[ FIM ]-------------- //
    
    
    
    
    
    
    
    
    

    // ----------------------------------[ Auditoria ]---------------------------------- //

    /*
     * Listando os dados da auditoria 
     */
    public function select_auditoria() {
        $this->sql = "SELECT ta.dt_registro,ta.str_usr_criador,tgt.str_descricao,tp.str_num_paj FROM tb_auditoria AS ta
	INNER JOIN tb_generica_tabela AS tgt ON tgt.id_generica_tabela=ta.id_generica_tabela
	LEFT JOIN tb_processos AS tp ON tp.id_processos = ta.id_processos
        	ORDER BY ta.dt_registro DESC";
        // echo'<pre>';                var_dump($this->sql); exit;
        return $this->query();
    }

  
    /*
     * Buscando modulo
     */
    public function modulo($modulo) {
        $this->sql = "SELECT * FROM gr_modulo WHERE str_modulo = '$modulo' ";
        // var_dump(  $this->sql);
        return $this->query();
    }

    /*
     * Buscando view
     */
    public function view($view, $idmodulo) {
        $this->sql = "SELECT * FROM gr_view WHERE str_view = '$view' AND id_modulo='$idmodulo' ";
        // var_dump(  $this->sql);
        return $this->query();
    }

    // ----------------------------------[  ]---------------------------------- //
    
    
    
    
    
    
    
    
    
    
    
    // ----------------------------------[  ]---------------------------------- //

    function montar_select($tabela, $condicao = null, $order = null, $campo_tabela1, $campo_tabela2) {

        $this->sql = " SELECT * FROM {$tabela}";
        if (!empty($condicao))
            $this->sql .= ' ' . $condicao;
        if (!empty($order))
            $this->sql .= " ORDER BY $order";
        $consulta = $this->query();

        while ($dados = mssql_fetch_array($consulta)) {
            print("<option value='" . utf8_encode($dados["$campo_tabela1"]) . "' >" . utf8_encode($dados["$campo_tabela2"]) . "</option>");
        }
        //return $this->query();
    }

    function montar_select_selecionado1($tabela, $condicao = null, $order = null, $campo_tabela1, $campo_tabela2, $dado) {

        $this->sql = " SELECT * FROM {$tabela}";
        if (!empty($condicao))
            $this->sql .= ' ' . $condicao;
        if (!empty($order))
            $this->sql .= " ORDER BY $order";
        $consulta = $this->query();

        while ($dados = mssql_fetch_array($consulta)) {
            if ($dado == $dados["$campo_tabela1"]) {
                print("<option value='" . utf8_encode($dados["$campo_tabela1"]) . "' selected>" . utf8_encode($dados["$campo_tabela2"]) . "</option>");
            } else {
                print("<option value='" . utf8_encode($dados["$campo_tabela1"]) . "' >" . utf8_encode($dados["$campo_tabela2"]) . "</option>");
            }
        }
        //return $this->query();
    }

    function pegar_ultimo_id() {
        $this->sql = "select_ultimo_id_processos";
        // var_dump(  $this->sql);
        $consultaSql = $this->query();
        $ultimo_id = '';
        while ($dados = mssql_fetch_array($consultaSql)) {
            $ultimo_id = $dados['id'];
        }
        return $ultimo_id;
    }

  

}

?>