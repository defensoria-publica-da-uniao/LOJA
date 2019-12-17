<?php
    @session_start();
    //Substituir require_once por _SESSION['PATH'];
    require_once $_SESSION['PATH']. 'controller/controller.php';
    class MUnidade extends controller{

        function listarUnidade($id = null) {

            (($id>0) ? $where = " WHERE tu.id_unidade = {$id}" : $where = null);

            $this->sql = " SELECT tu.*, te.str_uf
                        FROM tb_unidade AS tu
                        INNER JOIN tb_estado AS te ON te.id_estado = tu.id_estado
                        $where";

            return $this->query();

        }
                
        function listarTodasUnidades() {
        
            $this->sql = "SELECT id_unidade, str_descricao, str_email, str_situacao, str_uf, tu.id_estado FROM tb_unidade AS tu
            INNER JOIN tb_estado AS te ON te.id_estado = tu.id_estado
            ORDER BY str_uf ASC";

            return $this->query();
        }
                
    }

?>