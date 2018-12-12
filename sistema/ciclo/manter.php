<?php
include_once (__DIR__ . "/../include/conexao.php");
include_once (__DIR__ . "/../classes/clsCiclo.php");

$acao = $_REQUEST['acao'];
$cod_id = $_REQUEST['id'];

switch ($acao) {
    case 'excluir':
        $txt_caminho_documento  = getcwd()."\\digital\\";
        $sql = "SELECT txt_arquivo FROM tb_ciclo_planejamento WHERE cod_tipo_documento = ".$cod_id;
        $q1 = pg_query($sql);
        $rs1 = pg_fetch_array($q1);

        $clsCiclo = new clsCiclo();
        $clsCiclo->cod_tipo_documento = $cod_id;        
        $clsCiclo->ExcluirArquivo();             

        //APAGAR O ARQUIVO DA PASTA
        unlink($txt_caminho_documento.$rs1['txt_arquivo']);
        break;
}

?>