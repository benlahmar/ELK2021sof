<?php
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

//Récupérer les opération par mois

//Et calculer la moyen des amounts et 
//la somme des balance

$params=[
    "index"=>"bank2022",
    
    "body"=>[
        "size"=>0,
         "aggs"=>[
                    "bydate"=>[
                        "date_histogram"=>[
                            "field"=>"operations.operationDate",
                            "interval"=>"month",
                            "keyed"=>true
                        ],
                        "aggs"=>[
                            "moy"=>[
                                "avg"=>[
                                    "field"=>"operations.amount"
                                ]
                                ],
                            "som"=>[
                                    "sum"=>[
                                        "field"=>"balance"
                                    ]
                                ]                               
                        ]
                    ]
                ]
        ]
    ];


    
    print_r(json_encode($params['body']));
    
    $rep=$client->search($params);



echo"<hr/>";
$aggs=$rep['aggregations'];
$bydate= $aggs['bydate']['buckets'];
$exp=$bydate['2014-05-01T00:00:00.000Z'];
echo "la moyen est :".$exp['moy']['value'];
var_dump($exp);
foreach($bydate as $b)
{
   echo $b['doc_count'];
}
var_dump($bydate);
?>