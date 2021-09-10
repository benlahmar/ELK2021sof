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
                 "bysex"=>[
                     "terms"=>[
                         "field"=>"gender.keyword"
                     ],
                     "aggs"=>[
                        "bydate"=>[
                            "date_range"=>[
                                "field"=>"operations.operationDate",
                                "keyed"=>true,
                                "ranges"=>[
                                    [
                                        "from"=> "2014-12-25",
                                        "to"=> "2016-12-25",
                                        "key"=>"data2014"
                                    ]
                                ]
                                    ],
                                    "aggs"=>[
                                        "top"=>[
                                            "top_hits"=>[
                                                "size"=>2
                                            ]
                                        ]
                                    ]
                        ]
                     ]
                 ]                
                ]
        ]
    ];


    
    print_r(json_encode($params['body']));
    $rep=$client->search($params);
    $aggs=$rep['aggregations'];
    echo "<hr/>";
    
    $data=$aggs["bysex"]["buckets"][0]["bydate"]["buckets"]["data2014"]["top"]["hits"]["hits"];
    var_dump($data);
   // ;
    $b0=$data[0]["_source"]["balance"];
    echo"<hr/>";
    echo $b0;
    echo"<hr/>";
    var_dump($aggs);
echo"<hr/>";
var_dump($aggs['bysex']['buckets']);

echo"<hr/>";
var_dump($aggs['bysex']['buckets']);


?>