<?php
include_once (__DIR__ . "/../include/conexao.php");
include_once (__DIR__ . "/../classes/clsCiclo.php");

verifica_seguranca();
cabecalho();
permissao_acesso_pagina(92);
 
if (empty($_REQUEST['log'])) {    
	Auditoria(129, "Listar Ciclo do Planejamento", "");
}

$clsCiclo = new clsCiclo();
?>
 
<div id="main" class="container" style="margin-top: 50px">    
    <form id="frm1"> 
        <input type="hidden" name="log" id="log" value="1" />       
        <div class="row">
            <div class="col-md-12">
                <h3>Ciclo Geral do Planejamento SES-DF</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <?php if (permissao_acesso(94)) { ?>
                    <a href="incluir.php" class="btn btn-primary pull-right h2">Incluir Arquivos</a>
                <?php } ?>							
            </div>
        </div>
        <br />  
        <div class="row">
            <div class="col-md-12">                
                <img src="painel_ciclo.png" alt="Ciclo Geral do Planejamento SES-DF" usemap="#planetmap">
            </div>
        </div>
    </form>      
</div>
<?php
$cadeia_valor = $clsCiclo->RetornaArquivo(1);
$mapa_estrategico = $clsCiclo->RetornaArquivo(2);
$pds = $clsCiclo->RetornaArquivo(3);
$ldo = $clsCiclo->RetornaArquivo(5);
$ppa = $clsCiclo->RetornaArquivo(4);
$ar = $clsCiclo->RetornaArquivo(6);
?>
<map name="planetmap">  
  <area shape="rect" coords="369,196,454,246" href="<?php echo($_SESSION["txt_caminho_aplicacao"]); ?>/pas/opcao.php">
  <area shape="rect" coords="664,120,901,171" href="<?php echo($_SESSION["txt_caminho_aplicacao"]); ?>/sag/opcao.php">
  <area shape="rect" coords="134,115,214,105" <?php echo("href='".$_SESSION["txt_caminho_aplicacao"]."/visualizador/web/viewer.html?file=".urlencode($_SESSION['txt_caminho_aplicacao']."/ciclo/digital/".$cadeia_valor)."'") ?> >
  <area shape="rect" coords="188,132,262,170" <?php echo("href='".$_SESSION["txt_caminho_aplicacao"]."/visualizador/web/viewer.html?file=".urlencode($_SESSION['txt_caminho_aplicacao']."/ciclo/digital/".$mapa_estrategico)."'") ?> >
  <area shape="rect" coords="370,122,453,171" <?php echo("href='".$_SESSION["txt_caminho_aplicacao"]."/visualizador/web/viewer.html?file=".urlencode($_SESSION['txt_caminho_aplicacao']."/ciclo/digital/".$pds)."'") ?> >
  <area shape="rect" coords="458,197,539,244" <?php echo("href='".$_SESSION["txt_caminho_aplicacao"]."/visualizador/web/viewer.html?file=".urlencode($_SESSION['txt_caminho_aplicacao']."/ciclo/digital/".$ldo)."'") ?> >
  <area shape="rect" coords="458,123,628,169" <?php echo("href='".$_SESSION["txt_caminho_aplicacao"]."/visualizador/web/viewer.html?file=".urlencode($_SESSION['txt_caminho_aplicacao']."/ciclo/digital/".$ppa)."'") ?> >
  <area shape="rect" coords="178,197,364,247" <?php echo("href='".$_SESSION["txt_caminho_aplicacao"]."/visualizador/web/viewer.html?file=".urlencode($_SESSION['txt_caminho_aplicacao']."/ciclo/digital/".$ar)."'") ?> >
</map>
<?php
rodape($dbcon);
?>