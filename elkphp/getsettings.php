<?php
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

$params=[
    "index"=>"myblog2022017"
];
$sett=$client->indices()->getSettings($params);

echo json_encode($sett);
var_dump($sett);

?>