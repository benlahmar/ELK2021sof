<?php
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

//Récupérer les opérations des comptes depuis 5ans (entre deux dates)
// des f et f===>aggs terms
///dsl ? c equuoi cette quey===> traduire en php//
//date range
//et donner les soldes des 2 premiers comptes 

$params=[
    "index"=>"bank2022",
    "body"=>[
        "size"=>0,
             "aggs"=>[
                    "byage"=>[
                        "histogram"=>[
                            "field"=>"age",
                            "interval"=>2,
                            "keyed"=>true
                        ]
                    ]
                   
                ]
        ]
    ];


    
    print_r(json_encode($params['body']));
    $rep=$client->search($params);
    $aggs=$rep['aggregations'];
    echo "<hr/>";
    $ba=$aggs["byage"]['buckets'];
    var_dump($ba['30.0']);
    var_dump($aggs);
echo"<hr/>";

?>