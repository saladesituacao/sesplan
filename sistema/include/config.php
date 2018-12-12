<?php 
session_start();
$dominio= $_SERVER['HTTP_HOST'];
$url = "http://" . $dominio;
 
//LOCAL
$_SESSION["txt_host"] = $url;

if ($_SERVER['SERVER_NAME'] == "localhost") {
    $_SESSION["url_api_mgi"] = "";
    $_SESSION['ldap_server'] = "";
    $_SESSION['ldap_dominio'] = "";
    $_SESSION['ldap_endereco'] = "";
    $_SESSION['ldap_pass'] = "";
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