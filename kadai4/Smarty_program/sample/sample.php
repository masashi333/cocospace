<?php

require_once('Smarty.class.php');

$smarty = new Smarty();

$smarty->template_dir = '/home/co-67.3919.com/public_html/kadai4/Smarty_design/sample/templates/';
$smarty->compile_dir  = '/home/co-67.3919.com/public_html/kadai4/Smarty_design/sample/templates_c/';
$smarty->config_dir   = '/home/co-67.3919.com/public_html/kadai4/Smarty_design/sample/config/';
$smarty->cache_dir    = '/home/co-67.3919.com/public_html/kadai4/Smarty_design/sample/cache/';

$smarty->assign('msg','Hello World!');
$smarty->display('sample.tpl');

?>