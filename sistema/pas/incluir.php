<?php
include_once (__DIR__ . "/../include/conexao.php");
verifica_seguranca();
cabecalho();
permissao_acesso_pagina(68);

$cod_objetivo = $_REQUEST['cod_objetivo'];
$cod_objetivo_ppa = $_REQUEST['cod_objetivo_ppa'];
$txt_acao = $_REQUEST['txt_acao'];
$cod_orgao = $_REQUEST['cod_orgao'];
$cod_parceiro = $_REQUEST['cod_parceiro'];
$cod_mes_inicio = $_REQUEST['cod_mes_inicio'];
$cod_mes_fim = $_REQUEST['cod_mes_fim'];
$cod_meta = $_REQUEST['cod_meta'];
$codigo_acao = $_REQUEST['codigo_acao'];
$cod_continuar = $_REQUEST['cod_continuar'];

if(empty($verificado)) {    
    $cod_continuar = 1;
}
?>

<div id="main" class="container-fluid">
    <h3 class="page-header">PAS > Incluir</h3>
    <form id="frm1">         
        <input type="hidden" name="acao" id="acao" value="incluir" />
        <input type="hidden" name="verificado" id="verificado" value="1" />
        <input type="hidden" name="cod_objetivo_url" id="cod_objetivo_url" value="<?php echo($_REQUEST['cod_objetivo_url']) ?>" />
        <input type="hidden" name="cod_objetivo_ppa_url" id="cod_objetivo_ppa_url" value="<?php echo($_REQUEST['cod_objetivo_ppa_url']) ?>" />        
        <?php
        include_once (__DIR__ . "/../include/combo_objetivo.php"); 
        ?>
        <div class="row">
            <div class="col-md-12">
                <label for="exampleInputEmail1">Código da Ação:</label> 
                <input type="text" class="form-control" id="codigo_acao" name="codigo_acao" placeholder="Obrigatório" autocomplete="off">
            </div>
        </div> 
        <br />
        <div class="row">
            <div class="col-md-12">
                <label for="exampleInputEmail1">Ação:</label> 
                <textarea class="form-control" rows="5" id="txt_acao" name="txt_acao"><?=$txt_acao?></textarea>  
            </div>
        </div>  
        <br />      
        <div class="row">
            <div class="col-md-6">
                <label for="exampleInputEmail1">Responsável:</label> 
                <select id="cod_orgao" name="cod_orgao" class="chosen-select" data-placeholder="Obrigatório">
                    <option></option>
                    <?php                        
                        $q = pg_query("SELECT cod_orgao, txt_sigla FROM tb_orgao WHERE cod_ativo = 1 ORDER BY txt_sigla");
                        while ($row = pg_fetch_array($q)) 
                        { ?>
                            <option value="<?=$row["cod_orgao"]?>"<?php if ($cod_orgao == $row["cod_orgao"]) { echo("selected");}?>><?=$row["txt_sigla"] ?></option>
                        <?php	
                        } ?>									
                </select>
            </div>
            <div class="col-md-6">
                <label for="exampleInputEmail1">Parceiro:</label> 
                <select id="cod_parceiro" name="cod_parceiro" class="form-control">
                    <option></option>
                    <?php                        
                        $q = pg_query("SELECT cod_orgao, txt_sigla FROM tb_orgao WHERE cod_ativo = 1 ORDER BY txt_sigla");
                        while ($row = pg_fetch_array($q)) 
                        { ?>
                            <option value="<?=$row["cod_orgao"]?>"<?php if ($cod_parceiro == $row["cod_orgao"]) { echo("selected");}?>><?=$row["txt_sigla"] ?></option>
                        <?php	
                        } ?>									
                </select>
            </div>
        </div>    
        <br />    
        <div class="row">
            <div class="col-md-6">
                <label for="exampleInputEmail1">Início Previsto:</label> 
                <select id="cod_mes_inicio" name="cod_mes_inicio" class="chosen-select" data-placeholder="Obrigatório">
                    <option></option>
                    <?php                        
                    $q = pg_query("SELECT cod_mes, txt_mes FROM tb_pas_mes ORDER BY cod_mes");
                    while ($row = pg_fetch_array($q)) 
                    { ?>
                        <option value="<?=$row["cod_mes"]?>"<?php if ($cod_mes_inicio == $row["cod_mes"]) { echo("selected");}?>><?=$row["txt_mes"] ?></option>
                    <?php	
                    } ?>	
                </select>
            </div>
            <div class="col-md-6">
                <label for="exampleInputEmail1">Fim Previsto:</label>   
                <select id="cod_mes_fim" name="cod_mes_fim" class="chosen-select" data-placeholder="Obrigatório">
                    <option></option>
                    <?php                        
                    $q = pg_query("SELECT cod_mes, txt_mes FROM tb_pas_mes ORDER BY cod_mes");
                    while ($row = pg_fetch_array($q)) 
                    { ?>
                        <option value="<?=$row["cod_mes"]?>"<?php if ($cod_mes_fim == $row["cod_mes"]) { echo("selected");}?>><?=$row["txt_mes"] ?></option>
                    <?php	
                    } ?>	
                </select>             
            </div>
        </div> 
        <br /> 
        <div class="row">
            <div class="col-md-6">
                <label for="exampleInputEmail1">Meta Física:</label> 
                <input type="text" class="form-control" id="cod_meta" name="cod_meta" onkeypress="return isNumberKey(event)" placeholder="Obrigatório">
            </div>             
            <div class="col-md-6">
                <label for="exampleInputEmail1">Unidade de Medida:</label> 
                <input type="text" class="form-control" id="txt_medida" name="txt_medida" value="<?=$txt_medida?>">
            </div>                          
        </div>      
        <br />
        <div class="row">
            <div class="col-md-6">
                <label for="exampleInputEmail1">Continuar Cadastrando:</label> 
                <select id="cod_continuar" name="cod_continuar" class="form-control">
                    <option value="1" <?php
                                        if ($cod_continuar == 1) {
                                            echo("selected");
                                        }
                                        ?>>SIM</option>			
                    <option value="0"<?php
                                        if ($cod_continuar == 0) {
                                            echo("selected");
                                        }
                                        ?>>NÃO</option>
                </select>
            </div>
        </div>       
        <br />
        <div class="row">
            <div class="col-md-12">
                <button type="submit" id="btn_incluir" class="btn btn-primary" onclick="return ValidarIncluir();">Incluir</button>
                <a href="default.php" class="btn btn-default">Voltar</a>
            </div>
        </div>
    </form>
</div>
<script src="manter.js" type="text/javascript"></script>
<script type="text/javascript">
    /*jQuery(function($){                    
        $('#cod_meta').maskMoney({ prefix: '', allowNegative: false, thousands: '.', decimal: ',', affixesStay: false });                           
    });*/

    //MARCAR O OBJETIVO QUANDO A OPÇÃO CONTINUAR CADASTRANDO FOR IGUAL A 1
    if ($('#cod_objetivo_url').val() != '') {
        $('#cod_objetivo').val($('#cod_objetivo_url').val());
    }
    
</script>
<?php
rodape($dbcon);
?>
      