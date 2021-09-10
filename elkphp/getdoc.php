<?php
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();


$params=[
        "index"=>"indexphp",
        "id"=>"2",
        "client"=>[
            //"verbose"=>true,
            "ignore"=>404,
            "future"=>"lazy"//pour activer e mode future
        ]
    ];

    $rep=$client->get($params);

    var_dump($rep);
    echo "<hr/>";
    $rep->wait();
    $doc=$rep['_source'];//resolve result
    var_dump( $doc);
    echo "<hr/>";
    var_dump($rep);

?>