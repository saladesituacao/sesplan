$(document).ready(function() {    
    dashboard_eixo();
});

function tabelaStatus(valor) {
    $('#div_princ').hide();

    if (valor != '') {   
        fn_retorna_meta(valor);

        $.ajax({
            type: 'POST',
            url: 'include/painel.php',
            data: {
                acao: 'tabela_status',
                cod_modulo: valor              				
            },
            async: false,
            success: function (data) {                              
                var obj = JSON.parse(data);                
        
                var div = '';

                obj.forEach(function(i, item) {
                    div += '<div class="row">';                    
                    div += '<div class="col-md-12">';
                    div += '<input type="checkbox" class="form-check-input" name="cod_status[]" value="'+ i.cod_status +'">'
                    div += '&nbsp;' + i.txt_status.toUpperCase() + '';
                    div += '</div></div>';
                });
                
                $('#div_status').html(div);

                var div_meta_acao_etapa = '';
                //PAS
                if (valor == 1) {
                    /*div_meta_acao_etapa += '<div class="funkyradio" align="left">'
                    div_meta_acao_etapa += '<div class="funkyradio-success">';
                    div_meta_acao_etapa += '<input type="checkbox" id="btn_meta_acao_etapa" value=""></input>';
                    div_meta_acao_etapa += '<label for="btn_meta_acao_etapa">AÇÃO</label>'; 
                    div_meta_acao_etapa += '</div></div>';*/                    
                }   
                //SAG
                else if (valor == 2) {
                    /*div_meta_acao_etapa += '<div class="row"><div class="funkyradio" align="left">'
                    div_meta_acao_etapa += '<div class="funkyradio-success">';
                    div_meta_acao_etapa += '<input type="checkbox" id="btn_meta_acao_etapa" value=""></input>';
                    div_meta_acao_etapa += '<label for="btn_meta_acao_etapa">ETAPA</label>';                    
                    div_meta_acao_etapa += '</div></div></div>';*/                                                            
                }      
                //INDICADOR
                else if (valor == 3) {                                                                            
                    $('#div_princ').show();

                    fn_relogio();
                    /*
                    FusionCharts.ready(function() {
                        var fusioncharts = new FusionCharts({
                          type: 'angulargauge',
                          renderAt: 'div_alerta',
                          width: '200',
                          height: '150',
                          dataFormat: 'json',
                          dataSource: {
                              "chart": {
                                  "caption": "ALERTA",
                                  "subcaption": "",
                                  "lowerLimit": "0",
                                  "upperLimit": "100",
                                  "theme": "fusion"
                              },
                              "colorRange": {
                                  "color": [{
                                      "minValue": "0",
                                      "maxValue": "100",
                                      "code": "#FFFF00"
                                  }]
                              },
                              "dials": {
                                  "dial": [{
                                      "value": "67"
                                  }]
                              }
                          }
                        }
                      );
                      fusioncharts.render();
                    });      
                    */
                }        
                                            
            },				
            error: function (xhr, status, error) {
                alert(xhr.responseText);    				
            }
        });                  
    }    
}

function MarcarEmenda() {
    if ($('#btn_emenda_parlamentar').prop("checked")) {
        $('#btn_emenda_parlamentar').val('1');        
    } else {
        $('#btn_emenda_parlamentar').val('0');
    }
    
}

function dashboard_objetivo(cod_eixo, cod_perspectiva, cod_diretriz) {
    if (cod_eixo != '' && cod_perspectiva != '' && cod_diretriz != '') {        
        $.ajax({
            type: 'POST',
            url: 'include/painel.php',
            data: {
                acao: 'tabela_objetivo',
                cod_eixo: cod_eixo,
                cod_perspectiva: cod_perspectiva,
                cod_diretriz: cod_diretriz
            },
            async: false,
            success: function (data) {                              
                var obj = JSON.parse(data);                                            
                var div = '<div class="row col-md-12" align="left"><br />';            
                obj.forEach(function(i, item){                                                                      
                    div += '<div class="col-md-3" align="left">';                                        
                    div += '<input type="checkbox" class="form-check-input" id="btn_objetivo_'+ i.cod_objetivo +'" name="cod_objetivo[]" value="'+ i.cod_objetivo +'">'+ i.codigo_objetivo +'</input>';                    
                    div += '</div>'; 
                });  
                div += '</div>';           
    
                $('#div_objetivo').html(div);                                               
            },				
            error: function (xhr, status, error) {
                alert(xhr.responseText);    				
            }
        });         
    }
}

function dashboard_diretriz(cod_eixo, cod_perspectiva) {     
    $('#div_objetivo').html('');
    
    if (cod_eixo != '' && cod_perspectiva != '') {
        $.ajax({
            type: 'POST',
            url: 'include/painel.php',
            data: {
                acao: 'tabela_diretriz',
                cod_eixo: cod_eixo,
                cod_perspectiva: cod_perspectiva            
            },
            async: false,
            success: function (data) {                              
                var obj = JSON.parse(data);                                            
                var div = '<div class="row col-md-12" align="left"><br />';         
                obj.forEach(function(i, item){                                                                        
                    div += '<div class="col-md-3" align="left">';                                        
                    div += '<input type="radio" class="form-check-input" id="btn_diretriz_'+ i.cod_diretriz +'" name="cod_diretriz[]" value="'+ i.cod_diretriz +'" onclick="dashboard_objetivo('+ cod_eixo +', '+ cod_perspectiva +', '+ i.cod_diretriz +');">'+ i.txt_titulo +'</input>';                    
                    div += '</div>'; 
                });            
                div += '</div>'; 

                $('#div_diretriz').html(div);                
            },				
            error: function (xhr, status, error) {
                alert(xhr.responseText);    				
            }
        }); 
    }
}

function dashboard_perspectiva(valor) {    
    $('#div_diretriz').html('');
    $('#div_objetivo').html('');

    if (valor != '') {
        $.ajax({
            type: 'POST',
            url: 'include/painel.php',
            data: {
                acao: 'tabela_perspectiva',
                cod_eixo: valor            
            },
            async: false,
            success: function (data) {                              
                var obj = JSON.parse(data);                                            
                var div = '<div class="row col-md-12" align="left"><br />';                             
                obj.forEach(function(i, item) {                                       
                    div += '<div class="col-md-4" align="left">';                    
                    div += '<input type="radio" class="form-check-input" id="btn_perspectiva_'+ i.cod_perspectiva +'" name="cod_perspectiva[]" value="'+ i.cod_perspectiva +'" onclick="dashboard_diretriz('+ valor +', '+ i.cod_perspectiva +');">'+ i.txt_perspectiva +'</input>';                    
                    div += '</div>'; 
                });            
                div += '</div>'; 
    
                $('#div_perspectiva').html(div);                             
            },				
            error: function (xhr, status, error) {
                alert(xhr.responseText);    				
            }
        }); 
    }
}

function dashboard_eixo() {    
    $.ajax({
        type: 'POST',
        url: 'include/painel.php',
        data: {
            acao: 'tabela_eixo'                
        },
        async: false,
        success: function (data) {                              
            var obj = JSON.parse(data);                                            
            var div = '';  
           
            obj.forEach(function(i, item) {                                               
                div += '<div class="col-md-4" align="left">';                
                div += '<input type="radio" class="form-check-input" id="btn_eixo_'+ i.cod_eixo +'" name="cod_eixo[]" value="'+ i.cod_eixo +'" onclick="dashboard_perspectiva('+ i.cod_eixo +');">'+ i.txt_eixo +'</input>';                
                div += '</div>';    
            });            

            $('#div_eixo').html(div);            
        },				
        error: function (xhr, status, error) {
            alert(xhr.responseText);    				
        }
    });    
}

function  fn_retorna_meta(i) {    
    var cod_exibir_meta_complemento = $('#cod_exibir_meta_complemento').val();        

    if (i != 3 && i != 2 && i != 4 && i != 1) {
        cod_exibir_meta_complemento = 0;
    } 
    else {        
        cod_exibir_meta_complemento = i;
    }

    $('#cod_exibir_meta_complemento').val(cod_exibir_meta_complemento);
    
    if (cod_exibir_meta_complemento == 3) {   
        $('#div_complemento').html('');

        $.ajax({
            type: 'POST',
            url: 'include/painel.php',
            data: {
                acao: 'tag_indicador'                
            },
            async: false,
            success: function (data) {                              
                var obj = JSON.parse(data);                                            
                //var div = '<center><font color="blue">INSTRUMENTOS DE PLANEJAMENTO</font></center>';                                
                var div = '';
                obj.forEach(function(i, item) {                                         
                    div += '<div class="col-md-4">';                                  
                    div += '<input type="checkbox" class="form-check-input" id="cod_tag_'+ i.ds_tag +'" name="cod_tag[]" value="'+ i.ds_tag +'">'+ i.ds_tag +'</input>';                    
                    div += '</div>'; 
                });                                         

                $('#div_complemento').html('<div class="col-md-12">' + div + '</div>'); 
                $('#div_espaco').html('<div class="row"><div class="col-md-12">&nbsp;</div></div>');                
    
            },				
            error: function (xhr, status, error) {
                alert(xhr.responseText);    				
            }
        });
    }
    else if (cod_exibir_meta_complemento == 2 || cod_exibir_meta_complemento == 4) {
        $('#div_complemento').html('');

        var div = '';

        if (cod_exibir_meta_complemento == 2) {
            //ETAPA SAG
            $.ajax({
                type: 'POST',
                url: 'include/painel.php',
                data: {
                    acao: 'etapa_sag'                
                },
                async: false,
                success: function (data) {                              
                    var obj = JSON.parse(data);  
                    div += '<div class="col-md-4">ETAPA';            
                    div += '<select id="cod_etapa_sag" name="cod_etapa_sag[]" data-placeholder="." multiple class="chosen-select">';
                    div += '<option></option>';                                      
                    obj.forEach(function(i, item) {                                            
                        div += '<option value="'+ i.cod_sag +'">'+ i.nr_etapa_trabalho +' - '+ i.txt_etapa_trabalho +'</option>';                      
                    });     
                    div +='</select></div>';

                },				
                error: function (xhr, status, error) {
                    alert(xhr.responseText);    				
                }
            }); 
            
            //Emenda Parlamentar
            div += '<div class="col-md-2">';
            div += 'EMENDA';                         
            div += '<select id="btn_emenda_parlamentar" name="btn_emenda_parlamentar" class="form-control">';
            div += '<option value="0">NÃO</option>';
            div += '<option value="1">SIM</option>';
            div +='</select></div>';     
            
            //EMPENHO
            div += '<div class="col-md-2">';
            div += 'EMPENHO';                         
            div += '<select id="btn_empenho" name="btn_empenho" class="form-control">';
            div += '<option value="0">NÃO</option>';
            div += '<option value="1">SIM</option>';
            div +='</select></div>';     
        }        
           
        /*div += '<div class="funkyradio" align="left">'
        div += '<div class="col-md-4">';
        div += '<div class="funkyradio-success">';
        div += '<input type="checkbox" id="btn_emenda_parlamentar" name="btn_emenda_parlamentar" value="" onclick="MarcarEmenda();"></input>';
        div += '<label for="btn_emenda_parlamentar">EMENDA PARLAMENTAR</label>';                    
        div += '</div></div></div>';*/

        $.ajax({
            type: 'POST',
            url: 'include/painel.php',
            data: {
                acao: 'programa_trabalho'                
            },
            async: false,
            success: function (data) {                              
                var obj = JSON.parse(data);      
                div += '<div class="col-md-4" align="left">' 
                div += 'PROGRAMA DE TRABALHO';                                                                                     
                div += '<select id="cod_progr" name="cod_progr[]" data-placeholder="." multiple class="chosen-select">';
                div += '<option></option>';
                obj.forEach(function(i, item) {                                            
                    div += '<option value="'+ i.cod_programa_trabalho +'">'+ i.nr_programa_trabalho +'</option>';

                    /*div += '<div class="funkyradio" align="left">'
                    div += '<div class="col-md-4">';
                    div += '<div class="funkyradio-success">';                    
                    div += '<input type="checkbox" id="cod_progr_'+ i.cod_programa_trabalho +'" name="cod_progr[]" value="'+ i.cod_programa_trabalho +'"></input>';
                    div += '<label for="cod_progr_'+ i.cod_programa_trabalho +'">'+ i.nr_programa_trabalho +'</label>';
                    div += '</div></div></div>'; */
                });     
                div +='</select></div>';

                $('#div_complemento').html(div);                                  
    
                $('#cod_progr').chosen();
            },				
            error: function (xhr, status, error) {
                alert(xhr.responseText);    				
            }
        });     
        
        if (cod_exibir_meta_complemento == 2) {
            $('#cod_etapa_sag').chosen(); 
        }        
    }
    else if (cod_exibir_meta_complemento == 1) {
        var div = '';
                        

        $.ajax({
            type: 'POST',
            url: 'include/painel.php',
            data: {
                acao: 'acao_pas'                
            },
            async: false,
            success: function (data) {                              
                var obj = JSON.parse(data);  
                div += '<div class="col-md-6">AÇÃO';            
                div += '<select id="cod_acao_pas" name="cod_acao_pas[]" data-placeholder="." multiple class="chosen-select">';
                div += '<option></option>';                                      
                obj.forEach(function(i, item) {                                            
                    div += '<option value="'+ i.cod_pas +'">'+ i.codigo_acao +' - '+ i.txt_acao +'</option>';
                  
                });     
                div +='</select></div>';

                $('#div_complemento').html(div);   
                $('#cod_acao_pas').chosen();                               
                    
            },				
            error: function (xhr, status, error) {
                alert(xhr.responseText);    				
            }
        });         
    }
    else if (cod_exibir_meta_complemento == 0) {
        $('#div_complemento').html('');                 
    }
      
}

function MarcarDesmarcar(id) {       
    if ($('#' + id + '').css('background-color') == 'rgb(252, 81, 13)') {
        $('#' + id + '').css('background-color', '#ffffff');        
    } else if($('#' + id + '').css('background-color') == 'rgb(244, 244, 244)' || $('#' + id + '').css('background-color') == 'rgb(255, 255, 255)') {
        $('#' + id + '').css('background-color', '#fc510d');
    }    
}

function Unidades(id) {
    var sigla = '';
    /*
    $.ajax({
        type: 'POST',
        url: 'include/painel.php',
        data: {
            acao: 'sigla_unidade',
            cod_orgao: id                
        },
        async: false,
        success: function (data) {                              
            var obj = JSON.parse(data);                    
            obj.forEach(function(i, item) { 
                sigla = i.txt_sigla            
            });                        
        },				
        error: function (xhr, status, error) {
            alert(xhr.responseText);    				
        }
    });     
    */    

    var div = '';

    $.ajax({
        type: 'POST',
        url: 'include/painel.php',
        data: {
            acao: 'unidades_filhas',
            cod_orgao: id                
        },
        async: false,
        success: function (data) {                              
            var obj = JSON.parse(data);                    
            obj.forEach(function(i, item) { 
                div += '<div class="row col-md-12">'                                           
                //div += '<input type="checkbox" class="form-check-input" name="cod_orgao[]" value="'+ i.cod_orgao +'">&nbsp;'+ i.txt_sigla.replace(sigla + "/", "") +'</input>';
                div += '<input type="checkbox" class="form-check-input" name="cod_orgao[]" value="'+ i.cod_orgao +'">&nbsp;'+ i.txt_sigla +'</input>';
                div += '<a class="btn btn btn-xs" id="btn_cod_orgao_2_'+ i.cod_orgao +'" onclick="Unidades2('+ i.cod_orgao +');">+</a>';
                div += '<div id="div_cod_orgao_2_'+ i.cod_orgao +'"</div>';
                div += '</div>';
            });                        
        },				
        error: function (xhr, status, error) {
            alert(xhr.responseText);    				
        }
    });      
    
    $('#div_cod_orgao_' + id).html(div);
}

function Unidades2(id) {    
    var div = '';

    $.ajax({
        type: 'POST',
        url: 'include/painel.php',
        data: {
            acao: 'unidades_filhas',
            cod_orgao: id                
        },
        async: false,
        success: function (data) {                              
            var obj = JSON.parse(data);                    
            obj.forEach(function(i, item) { 
                div += '<div class="row col-md-12">'                                                           
                div += '<input type="checkbox" class="form-check-input" name="cod_orgao[]" value="'+ i.cod_orgao +'">&nbsp;'+ i.txt_sigla +'</input>';                
                div += '</div>';
            });                        
        },				
        error: function (xhr, status, error) {
            alert(xhr.responseText);    				
        }
    });      
    
    $('#div_cod_orgao_2_' + id).html(div);
}

function fn_relogio() {
    var opts_alerta = {
        angle: 0.15, // The span of the gauge arc
        lineWidth: 0.44, // The line thickness
        radiusScale: 1, // Relative radius
        pointer: {
          length: 0.6, // // Relative to gauge radius
          strokeWidth: 0.035, // The thickness
          color: '#000000' // Fill color
        },
        limitMax: false,     // If false, max value increases automatically if value > maxValue
        limitMin: false,     // If true, the min value of the gauge will be fixed
        colorStart: '#FFFF00',   // Colors
        colorStop: '#FFFF00',    // just experiment with them
        strokeColor: '#FFFF00',  // to see which ones work best for you
        generateGradient: true,
        highDpiSupport: true,     // High resolution support
        
      };
      var target = document.getElementById('div_alerta'); // your canvas element
      var gauge = new Gauge(target).setOptions(opts_alerta); // create sexy gauge!
      gauge.maxValue = 100; // set max gauge value
      gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
      gauge.animationSpeed = 32; // set animation speed (32 is default value)
      
        $.ajax({
            type: 'POST',
            url: 'include/painel.php',
            data: {
                acao: 'porcentagem_indicador',
                cod_status: 16          
            },
            async: false,
            success: function (data) {                                     
                gauge.set(data); // set actual value 
                $('#div_alerta_result').html('<strong>ALERTA '+ data +'%</strong><br />');  
                $('#hidden_alerta_result').val(data);                                        
            },				
            error: function (xhr, status, error) {
                alert(xhr.responseText);    				
            }
        });       
      
      /*---------------------------------------------------------------------------*/

      var opts_muito_critico = {
        angle: 0.15, // The span of the gauge arc
        lineWidth: 0.44, // The line thickness
        radiusScale: 1, // Relative radius
        pointer: {
          length: 0.6, // // Relative to gauge radius
          strokeWidth: 0.035, // The thickness
          color: '#000000' // Fill color
        },
        limitMax: false,     // If false, max value increases automatically if value > maxValue
        limitMin: false,     // If true, the min value of the gauge will be fixed
        colorStart: '#FF3333',   // Colors
        colorStop: '#FF3333',    // just experiment with them
        strokeColor: '#FF3333',  // to see which ones work best for you
        generateGradient: true,
        highDpiSupport: true,     // High resolution support
        
      };
      var target = document.getElementById('div_muito_critico'); // your canvas element
      var gauge = new Gauge(target).setOptions(opts_muito_critico); // create sexy gauge!
      gauge.maxValue = 100; // set max gauge value
      gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
      gauge.animationSpeed = 32; // set animation speed (32 is default value)
      
      $.ajax({
        type: 'POST',
        url: 'include/painel.php',
        data: {
            acao: 'porcentagem_indicador',
            cod_status: 17          
        },
        async: false,
        success: function (data) {                                     
            gauge.set(data); // set actual value 
            $('#div_muito_critico_result').html('<strong>MUITO CRÍTICO '+ data +'%</strong><br />');  
            $('#hidden_muito_critico_result').val(data);
        },				
        error: function (xhr, status, error) {
            alert(xhr.responseText);    				
        }
    });   

      /*---------------------------------------------------------------------------*/

      var opts_critico = {
        angle: 0.15, // The span of the gauge arc
        lineWidth: 0.44, // The line thickness
        radiusScale: 1, // Relative radius
        pointer: {
          length: 0.6, // // Relative to gauge radius
          strokeWidth: 0.035, // The thickness
          color: '#000000' // Fill color
        },
        limitMax: false,     // If false, max value increases automatically if value > maxValue
        limitMin: false,     // If true, the min value of the gauge will be fixed
        colorStart: '#FF9933',   // Colors
        colorStop: '#FF9933',    // just experiment with them
        strokeColor: '#FF9933',  // to see which ones work best for you
        generateGradient: true,
        highDpiSupport: true,     // High resolution support
        
      };
      var target = document.getElementById('div_critico'); // your canvas element
      var gauge = new Gauge(target).setOptions(opts_critico); // create sexy gauge!
      gauge.maxValue = 100; // set max gauge value
      gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
      gauge.animationSpeed = 32; // set animation speed (32 is default value)
      
        $.ajax({
            type: 'POST',
            url: 'include/painel.php',
            data: {
                acao: 'porcentagem_indicador',
                cod_status: 18          
            },
            async: false,
            success: function (data) {                                     
                gauge.set(data); // set actual value 
                $('#div_critico_result').html('<strong>CRÍTICO '+ data +'%</strong><br />');   
                $('#hidden_critico_result').val(data);                                       
            },				
            error: function (xhr, status, error) {
                alert(xhr.responseText);    				
            }
        });   

      /*---------------------------------------------------------------------------*/

      var opts_esperado = {
        angle: 0.15, // The span of the gauge arc
        lineWidth: 0.44, // The line thickness
        radiusScale: 1, // Relative radius
        pointer: {
          length: 0.6, // // Relative to gauge radius
          strokeWidth: 0.035, // The thickness
          color: '#000000' // Fill color
        },
        limitMax: false,     // If false, max value increases automatically if value > maxValue
        limitMin: false,     // If true, the min value of the gauge will be fixed
        colorStart: '#009933',   // Colors
        colorStop: '#009933',    // just experiment with them
        strokeColor: '#009933',  // to see which ones work best for you
        generateGradient: true,
        highDpiSupport: true,     // High resolution support
        
      };
      var target = document.getElementById('div_esperado'); // your canvas element
      var gauge = new Gauge(target).setOptions(opts_esperado); // create sexy gauge!
      gauge.maxValue = 100; // set max gauge value
      gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
      gauge.animationSpeed = 32; // set animation speed (32 is default value)
      
      $.ajax({
        type: 'POST',
        url: 'include/painel.php',
        data: {
            acao: 'porcentagem_indicador',
            cod_status: 19          
        },
        async: false,
        success: function (data) {                                     
            gauge.set(data); // set actual value 
            $('#div_esperado_result').html('<strong>ESPERADO '+ data +'%</strong><br />');    
            $('#hidden_esperado_result').val(data);                                      
        },				
        error: function (xhr, status, error) {
            alert(xhr.responseText);    				
        }
    });   

      /*---------------------------------------------------------------------------*/

      var opts_superado = {
        angle: 0.15, // The span of the gauge arc
        lineWidth: 0.44, // The line thickness
        radiusScale: 1, // Relative radius
        pointer: {
          length: 0.6, // // Relative to gauge radius
          strokeWidth: 0.035, // The thickness
          color: '#000000' // Fill color
        },
        limitMax: false,     // If false, max value increases automatically if value > maxValue
        limitMin: false,     // If true, the min value of the gauge will be fixed
        colorStart: '#00CCFF',   // Colors
        colorStop: '#00CCFF',    // just experiment with them
        strokeColor: '#00CCFF',  // to see which ones work best for you
        generateGradient: true,
        highDpiSupport: true,     // High resolution support
        
      };
      var target = document.getElementById('div_superado'); // your canvas element
      var gauge = new Gauge(target).setOptions(opts_superado); // create sexy gauge!
      gauge.maxValue = 100; // set max gauge value
      gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
      gauge.animationSpeed = 32; // set animation speed (32 is default value)
      
      $.ajax({
        type: 'POST',
        url: 'include/painel.php',
        data: {
            acao: 'porcentagem_indicador',
            cod_status: 20          
        },
        async: false,
        success: function (data) {                                     
            gauge.set(data); // set actual value 
            $('#div_superado_result').html('<strong>SUPERADO '+ data +'%</strong><br />');   
            $('#hidden_superado_result').val(data);                                       
        },				
        error: function (xhr, status, error) {
            alert(xhr.responseText);    				
        }
    });  

    /*---------------------------------------------------------------------------*/

    var opts_nao_analisado = {
        angle: 0.15, // The span of the gauge arc
        lineWidth: 0.44, // The line thickness
        radiusScale: 1, // Relative radius
        pointer: {
          length: 0.6, // // Relative to gauge radius
          strokeWidth: 0.035, // The thickness
          color: '#000000' // Fill color
        },
        limitMax: false,     // If false, max value increases automatically if value > maxValue
        limitMin: false,     // If true, the min value of the gauge will be fixed
        colorStart: '#D1D3D4',   // Colors
        colorStop: '#D1D3D4',    // just experiment with them
        strokeColor: '#D1D3D4',  // to see which ones work best for you
        generateGradient: true,
        highDpiSupport: true,     // High resolution support
        
      };
      var target = document.getElementById('div_nao_analisado'); // your canvas element
      var gauge = new Gauge(target).setOptions(opts_nao_analisado); // create sexy gauge!
      gauge.maxValue = 100; // set max gauge value
      gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
      gauge.animationSpeed = 32; // set animation speed (32 is default value)
      
      $.ajax({
        type: 'POST',
        url: 'include/painel.php',
        data: {
            acao: 'porcentagem_indicador',
            cod_status: "0",
            hidden_alerta_result: $('#hidden_alerta_result').val(),
            hidden_muito_critico_result: $('#hidden_muito_critico_result').val(),
            hidden_critico_result: $('#hidden_critico_result').val(),
            hidden_esperado_result: $('#hidden_esperado_result').val(),
            hidden_superado_result: $('#hidden_superado_result').val()
        },
        async: false,
        success: function (data) {            
            gauge.set(data); // set actual value 
            $('#div_nao_analisado_result').html('<strong>NÃO ANALISADO '+ data +'%</strong><br />');                                               
        },				
        error: function (xhr, status, error) {
            alert(xhr.responseText);    				
        }
    });

    /*---------------------------------------------------------------------------*/
}