<?php

require_once('Smarty.class.php');

$smarty = new Smarty();

$smarty->template_dir = 'http://co-67.3919.com/kadai4/smarty_design/templates/';
$smarty->compile_dir  = 'http://co-67.3919.com/kadai4/smarty_design/templates_c/';
$smarty->config_dir   = 'http://co-67.3919.com/kadai4/smarty_design/configs/';
$smarty->cache_dir    = 'http://co-67.3919.com/kadai4/smarty_design/cache/';

$smarty->assign('msg','Hello World!');
$smarty->display('sample.tpl');

?>