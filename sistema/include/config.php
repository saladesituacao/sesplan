<?php 
session_start();
$dominio= $_SERVER['HTTP_HOST'];
$url = "http://" . $dominio;
 
//LOCAL
$_SESSION["txt_host"] = $url;

if ($_SERVER['SERVER_NAME'] != "localhost") {
    $_SESSION["url_api_mgi"] = "http://api.saude.df.gov.br";
    $_SESSION['ldap_server'] = "10.86.1.80";
    $_SESSION['ldap_dominio'] = "@saude.df.gov.br";
    $_SESSION['ldap_endereco'] = "sala.situacao@saude.df.gov.br";
    $_SESSION['ldap_pass'] = 'salasituacao@dgie';
} else {
    $_SESSION["url_api_mgi"] = getenv('SESAPI');
    $_SESSION['ldap_server'] = getenv('LDAPSERVER');
    $_SESSION['ldap_dominio'] = getenv('LDAPDOMINIO');
    $_SESSION['ldap_endereco'] = getenv('LDAPENDERECO');
    $_SESSION['ldap_pass'] = getenv('LDAPPASS');
}
 
$_SESSION["txt_pagina_login"] = $_SESSION["txt_host"]."/sesplan/index.html";
$_SESSION["txt_caminho_aplicacao"] = $_SESSION["txt_host"]."/sesplan/sistema";
$_SESSION["txt_sigla_sistema"] = "SESPLAN";
$_SESSION["txt_pagina_inicial"] = $_SESSION["txt_caminho_aplicacao"]."/index.php";
$_SESSION["txt_tipo_autenticacao"] = "1"; //1 = LDAP, 2 = API

?>