<?php
header("Content-Type: text/html; charset=UTF-8");
$opts = array('http' => array('method' => 'GET',
'header' => 'TDCProjectKey:5a83a756-bdf5-4b7c-9841-8b1e362c1f34'));
$context = stream_context_create($opts);
$ddate = date('Y-m-d');
$date = new DateTime($ddate);
$year = $date -> format("Y");
$url = "https://apis.sktelecom.com/v1/eventday/days?year=".$year;
$fp = fopen($url, 'r', false, $context);

echo stream_get_contents($fp);
?>