<?php
$index_path = '../';

require_once($index_path.'library/MantellaCronTask.php');
$cronTask = new MantellaCronTask($index_path, 'config.ini', NULL);

$cronTask->writeLog('EXAMPLE', 'Result: SUCCESS');
