<?php
exec("/etc/cron status",$out,$ret);
print_r($out);
var_dump($ret);
exec("crontab -l",$out2,$ret2);
print_r($out2);
var_dump($ret2);