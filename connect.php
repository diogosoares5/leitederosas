<?php
$conexao = mysql_connect("200.155.28.151","leitede_lrosas","in70r3")
or die("acesso de Banco de Dados Errada");
$db = mysql_select_db("leitede_p1lrw",$conexao)
or die("Cofiguração de Banco de Dados Errada");
$s = mysql_query("SELECT * FROM newsletteremails WHERE email_newsletter = '".mysql_real_escape_string($email)."'");
?>