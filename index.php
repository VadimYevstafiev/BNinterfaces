<?php

header('Content-Type: text/plain; charset=UTF-8');
require_once("IncludeBNinterfaces.php");

$start = DateTime::createFromFormat("d.m.Y H:i:s", '25.10.2022 12:00:00')->getTimestamp() * 1000;
$finish = DateTime::createFromFormat("d.m.Y H:i:s", '03.11.2022 00:00:00')->getTimestamp() * 1000;

for ($i = 0; $i < 6; $i++) {
   $data = BNdailyAccountSnapshot::SendQuery('SPOT', $start, $finish);
     echo ' $i = ' . $i . PHP_EOL;
     echo '$data:' . PHP_EOL;
}

var_dump($data);
