<?php
include_once (__DIR__ . "/conexao.php");

$acao = $_REQUEST['acao'];
$cod_modulo = $_REQUEST['cod_modulo'];
$cod_eixo = $_REQUEST['cod_eixo'];
$cod_perspectiva = $_REQUEST['cod_perspectiva'];
$cod_diretriz = $_REQUEST['cod_diretriz'];
$cod_orgao = $_REQUEST['cod_orgao'];
$cod_status = $_REQUEST['cod_status'];

switch ($acao) {
    case 'tabela_status':
        $sql = "SELECT tbsm.cod_status, tbs.txt_status FROM tb_status_modulo tbsm ";
        $sql .= " INNER JOIN tb_status tbs ON tbs.cod_status = tbsm.cod_status ";
        $sql .= " WHERE tbsm.cod_exibir_consulta = 1 AND tbsm.cod_modulo = ".$cod_modulo;

        $query = pg_query($sql);        
        $arr = array();

        if(pg_num_rows($query) > 0) {
            while($row = pg_fetch_assoc($query)) {
                $arr[] = $row;  
            } 
        }                
        echo(json_encode($arr));
        break;

    case 'tabela_eixo':
        $sql = "SELECT * FROM tb_eixo WHERE cod_ativo = 1 ORDER BY cod_eixo";
        $query = pg_query($sql);        
        $arr = array();

        if(pg_num_rows($query) > 0) {
            while($row = pg_fetch_assoc($query)) {
                $arr[] = $row;  
            } 
        }                
        echo(json_encode($arr));
        break;

    case 'tabela_perspectiva':
        $sql = "SELECT * FROM tb_perspectiva WHERE cod_eixo = ".$cod_eixo." AND cod_ativo = 1 ORDER BY cod_perspectiva";
        $query = pg_query($sql);        
        $arr = array();

        if(pg_num_rows($query) > 0) {
            while($row = pg_fetch_assoc($query)) {
                $arr[] = $row;  
            } 
        }                
        echo(json_encode($arr));
        break;
    
    case 'tabela_diretriz':
        $sql = "SELECT * FROM tb_diretriz WHERE cod_eixo = ".$cod_eixo." AND cod_perspectiva = ".$cod_perspectiva;
        $sql .= " AND cod_ativo = 1 ORDER BY cod_diretriz";        
        $query = pg_query($sql);        
        $arr = array();

        if(pg_num_rows($query) > 0) {
            while($row = pg_fetch_assoc($query)) {
                $arr[] = $row;  
            } 
        }                
        echo(json_encode($arr));
        break;

    case 'tabela_objetivo':
        $sql = "SELECT * FROM tb_objetivo WHERE cod_eixo = ".$cod_eixo." AND cod_perspectiva = ".$cod_perspectiva;
        $sql .= " AND cod_diretriz = ".$cod_diretriz." AND cod_ativo = 1 ORDER BY cod_objetivo";        
        $query = pg_query($sql);        
        $arr = array();

        if(pg_num_rows($query) > 0) {
            while($row = pg_fetch_assoc($query)) {
                $arr[] = $row;  
            } 
        }                
        echo(json_encode($arr));
        break;

    case 'tag_indicador':
        $sql = "SELECT ds_tag, (SELECT COUNT(ds_tag) FROM tb_indicador_tag) AS qtd FROM tb_indicador_tag GROUP BY ds_tag ORDER BY ds_tag";
        $query = pg_query($sql);    
        $arr = array();

        if(pg_num_rows($query) > 0) {
            while($row = pg_fetch_assoc($query)) {
                $arr[] = $row;  
            } 
        }                
        echo(json_encode($arr));
        break;
    
    case 'programa_trabalho':
        $sql = "SELECT tpt.cod_programa_trabalho, tpt.nr_programa_trabalho FROM tb_sag ts ";
        $sql .= " INNER JOIN tb_programa_trabalho tpt ON tpt.cod_programa_trabalho = ts.cod_programa_trabalho ";
        $sql .= " GROUP BY tpt.cod_programa_trabalho, tpt.nr_programa_trabalho ";
        $sql .= " ORDER BY tpt.nr_programa_trabalho ";        
        $query = pg_query($sql);    
        $arr = array();

        if(pg_num_rows($query) > 0) {
            while($row = pg_fetch_assoc($query)) {
                $arr[] = $row;  
            } 
        }                
        echo(json_encode($arr));
        break;

    case 'unidades_filhas':
        /*$sql = "WITH RECURSIVE arvore AS ";
        $sql .= " (SELECT t1.cod_orgao, txt_sigla, cod_exibir_consulta ";
        $sql .= " FROM tb_orgao AS t1 ";
        $sql .= " WHERE cod_orgao = ".$cod_orgao;
        $sql .= " UNION ALL SELECT t2.cod_orgao, t2.txt_sigla, t2.cod_exibir_consulta ";
        $sql .= " FROM tb_orgao AS t2 INNER JOIN arvore ON cod_orgao_superior = arvore.cod_orgao) "; 
        $sql .= " SELECT arvore.cod_orgao, arvore.txt_sigla, arvore.cod_exibir_consulta FROM arvore ";
        $sql .= " WHERE arvore.cod_orgao <> ".$cod_orgao." AND arvore.cod_exibir_consulta = 1 ORDER BY arvore.txt_sigla ";*/
        
        $sql = "SELECT * FROM tb_orgao WHERE cod_exibir_consulta = 1 AND cod_orgao_superior = ".$cod_orgao." AND cod_ativo = 1 ORDER BY txt_sigla";        
        $query = pg_query($sql);    
        $arr = array();

        if(pg_num_rows($query) > 0) {
            while($row = pg_fetch_assoc($query)) {
                $arr[] = $row;            
            } 
        }                
        echo(json_encode($arr));
        break;

    case 'sigla_unidade':
        $sql = "SELECT txt_sigla FROM tb_orgao WHERE cod_orgao = ".$cod_orgao;;

        $query = pg_query($sql);    
        $arr = array();

        if(pg_num_rows($query) > 0) {
            while($row = pg_fetch_assoc($query)) {
                $arr[] = $row;            
            } 
        }                
        echo(json_encode($arr));
        break;

    case 'acao_pas':
        $sql = "SELECT cod_pas, txt_acao, codigo_acao FROM tb_pas WHERE cod_ativo = 1 ORDER BY codigo_acao";
        $query = pg_query($sql);    
        $arr = array();

        if(pg_num_rows($query) > 0) {
            while($row = pg_fetch_assoc($query)) {
                $arr[] = $row;            
            } 
        }                
        echo(json_encode($arr));
        break;

    case 'etapa_sag':
        $sql = "SELECT cod_sag, txt_etapa_trabalho, nr_etapa_trabalho FROM tb_sag WHERE cod_ativo = 1 ORDER BY nr_etapa_trabalho";
        $query = pg_query($sql);    
        $arr = array();

        if(pg_num_rows($query) > 0) {
            while($row = pg_fetch_assoc($query)) {
                $arr[] = $row;            
            } 
        }                
        echo(json_encode($arr));
        break;

    case 'porcentagem_indicador':
        if ($cod_status != '0') {
            $sql = "SELECT cod_chave FROM tb_indicador";
            $query = pg_query($sql);
            if(pg_num_rows($query) > 0) {
                $total = pg_num_rows($query);

                $sql = "SELECT COUNT(tb.cod_chave) AS qtd FROM SESPLAN.tb_indicador_analise tb ";
                $sql .= " WHERE tb.cod_periodo = (SELECT MAX(t.cod_periodo) FROM SESPLAN.tb_indicador_analise t WHERE t.cod_chave = tb.cod_chave) ";
                $sql .= " AND tb.cod_status = ".$cod_status;
                $query = pg_query($sql);
                $row = pg_fetch_assoc($query);
                $total_status = $row['qtd'];

                $resultado = $total_status * 100;
                $resultado = $resultado / $total;
                $resultado = @number_format($resultado, 2, ',', '.');

                if (substr($resultado, -3) == ',00') {
                    $resultado = trim(str_replace(substr($resultado, -3), "", $resultado));  
                }

                echo($resultado);
            } else {
                echo("0");
            }    
        } else {
            $hidden_alerta_result = $_REQUEST['hidden_alerta_result'];
            $hidden_muito_critico_result = $_REQUEST['hidden_muito_critico_result'];
            $hidden_critico_result = $_REQUEST['hidden_critico_result'];
            $hidden_esperado_result = $_REQUEST['hidden_esperado_result'];
            $hidden_superado_result = $_REQUEST['hidden_superado_result'];

            $hidden_alerta_result = str_replace(',', '.', $hidden_alerta_result);
            $hidden_muito_critico_result = str_replace(',', '.', $hidden_muito_critico_result);
            $hidden_critico_result = str_replace(',', '.', $hidden_critico_result);
            $hidden_esperado_result = str_replace(',', '.', $hidden_esperado_result);
            $hidden_superado_result = str_replace(',', '.', $hidden_superado_result);

            $resultado = 100 - ($hidden_alerta_result + $hidden_muito_critico_result + $hidden_critico_result + $hidden_esperado_result + $hidden_superado_result);
            $resultado = str_replace('.', ',', $resultado);
            if (substr($resultado, -3) == ',00') {
                $resultado = trim(str_replace(substr($resultado, -3), "", $resultado));  
            }

            echo($resultado);
        }        

        break; 
}

?>