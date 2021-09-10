<?php
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();


$params=[
        "index"=>"indexphp",
        "id"=>"2",
        "body"=>["prenom"=>"jad"]
    ];

    $rep=$client->index($params);
    var_dump($rep);

?>