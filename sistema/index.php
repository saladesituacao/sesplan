<?php
include_once(__DIR__ . "/include/conexao.php");
verifica_seguranca();
cabecalho();

//js_alert(phpversion());
?>
<!-- Estilos Painel -->
<link href="<?php echo($_SESSION["txt_caminho_aplicacao"]); ?>/include/css/style_painel.css" rel="stylesheet">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo($_SESSION["txt_caminho_aplicacao"]); ?>/include/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo($_SESSION["txt_caminho_aplicacao"]); ?>/include/bower_components/font-awesome/css/font-awesome.min.css">

<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>

<script type="text/javascript" src="<?php echo($_SESSION["txt_caminho_aplicacao"]); ?>/include/js/gauge.js"></script>

<div id="main" class="container-fluid" >
  <form id="frm1" method="post" action="painel/pesquisa.php">
    <input type="hidden" name="condicao_query" id="condicao_query" value="" />
    <div class="row">&nbsp;</div><!--row--> 
    <div class="row">
      <div class="col-md-12">                    
        <div class="funkyradio">                      
          <?php 
          $q1 = pg_query("SELECT * FROM tb_modulo WHERE cod_exibir_consulta = 1");            
            while ($rs1 = pg_fetch_array($q1)) { ?> 
              <div class="col-md-3">                    
                <div class="funkyradio-success">     
                  <input type="radio" id="cod_modulo_<?=$rs1['cod_modulo']?>" name="cod_modulo" value="<?=$rs1['cod_modulo']?>" onclick="tabelaStatus(this.value);">
                  <label for="cod_modulo_<?=$rs1['cod_modulo']?>"><?=$rs1['txt_modulo']?></label>
                </div><!--funkyradio-success-->                
              </div><!--col-md-3-->
            <?php        
            } ?>                                      
        </div><!--funkyradio-->                 
      </div><!--col-md-12--> 
    </div><!--row--> 
    <hr />   
    <div class="row">
      <div class="col-md-9"> 
        <div id="div_princ">
          <div class="col-md-12">          
            <div id="div_meta_acao_etapa"></div> 
            <div class="row">
              <div class="col-md-4">  
                <div id='div_alerta_result'></div>                                          
                <canvas id="div_alerta" width="100" height="50"></canvas> 
                <input type="hidden" name="hidden_alerta_result" id="hidden_alerta_result" value="" />
              </div>
              <div class="col-md-4">  
                <div id='div_muito_critico_result'></div>             
                <canvas id="div_muito_critico" width="100" height="50"></canvas> 
                <input type="hidden" name="hidden_muito_critico_result" id="hidden_muito_critico_result" value="" />
              </div>
              <div class="col-md-4">    
                <div id='div_critico_result'></div>           
                <canvas id="div_critico" width="100" height="50"></canvas>
                <input type="hidden" name="hidden_critico_result" id="hidden_critico_result" value="" />
              </div>
            </div>   
            <div class="row"><div class="col-md-12">&nbsp;</div></div>
            <div class="row">
              <div class="col-md-4">
                <div id='div_esperado_result'></div>
                <canvas id="div_esperado" width="100" height="50"></canvas>                
                <input type="hidden" name="hidden_esperado_result" id="hidden_esperado_result" value="" />
              </div>              
              <div class="col-md-4">
                <div id='div_superado_result'></div>
                <canvas id="div_superado" width="100" height="50"></canvas>                
                <input type="hidden" name="hidden_superado_result" id="hidden_superado_result" value="" />
              </div>  
              <div class="col-md-4">
                <div id='div_nao_analisado_result'></div>
                <canvas id="div_nao_analisado" width="100" height="50"></canvas>
              </div>                          
            </div>            
          </div><!--jumbotron-->  
        </div>                                           

        <div id="div_espaco"></div>  
            
        <div class="row">                                    
          <div id="div_complemento"></div>
          <input type="hidden" name="cod_exibir_meta_complemento" id="cod_exibir_meta_complemento" value="0" />           
        </div>
        
        <div class="row">
          <div class="col-md-12">  
            <div class="jumbotron" style="background-image:url(<?php echo($_SESSION["txt_caminho_aplicacao"]) ?>/include/imagens/fundo_painel.jpg);" class="img-responsive">          
              <p>            
                <!--<center><font color="blue">ÁRVORE SES</font></center>-->
                <div class="row">
                  <div id="div_eixo"></div>               
                </div>
                <div class="row">
                  <div id="div_perspectiva"></div>
                </div>
                <div class="row">
                  <div id="div_diretriz"></div> 
                </div>
                <div class="row">
                  <div id="div_objetivo"></div>  
                </div>
              </p>
            </div> 
          </div>    
        </div>
      </div><!--col-md-9-->
      <div class="col-md-3">
        <div class="">
          <div align="left" style="text-align:center">
            <font color="blue">ÁREA RESPONSÁVEL</font>
          </div>
          <div align="left" style="text-align:left">
            <?php 
            $q1 = pg_query("SELECT * FROM tb_orgao WHERE cod_exibir_consulta = 1 AND cod_orgao_superior IS NULL AND cod_ativo = 1 AND txt_sigla NOT LIKE '%/%' ORDER BY txt_sigla");                     
              while ($rs1 = pg_fetch_array($q1)) { ?>     
                <div class="form-check">  
                  <div class="row col-md-12">                        
                    <input type="checkbox" class="form-check-input" id="cod_orgao_<?=$rs1['cod_orgao']?>" name="cod_orgao[]" value="<?=$rs1['cod_orgao']?>">&nbsp;<?=$rs1['txt_sigla']?>&nbsp;
                    <a class="btn btn btn-xs" id="btn_cod_orgao_<?=$rs1['cod_orgao']?>" onclick="Unidades(<?=$rs1['cod_orgao']?>);">+</a>
                  </div>                  
                  <div id="div_cod_orgao_<?=$rs1['cod_orgao']?>"></div>                 
                </div><!--form-check--> <?php
              } ?>            
          </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="">  
          <div align="left" style="text-align:center"><font color="blue">STATUS</font></div>
          <div id="div_status" align="left"></div>
          <br />
          <div align="left"><button type="submit" id="btn_pesquisar" class="btn btn-primary btn-sm">Pesquisar</button><div>          
        </div>
      </div><!--col-md-3-->
    </div><!--row-->      
    <div class="row">  
      <div class="col-md-12">
       
      </div><!--col-md-12-->            
    </div><!--row-->    
  </form>
</div><!--main-->
     
<script src="include/js/painel.js" type="text/javascript"></script>     
<script type="application/javascript">
  $(document).ready(function() {
    tabelaStatus(3);  

    document.getElementById('cod_modulo_3').checked = true;        
  });  
</script> 
<?php
rodape($dbcon);
?>   