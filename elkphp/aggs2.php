<?php
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

$params=[
    "index"=>"bank2022",
    "body"=>[
        "query"=>[
            "term"=>[
                "gender"=>[
                    "value"=>"female"
                ]
            ]
                ],
                "aggs"=>[
                    "byage"=>[
                        "avg"=>[
                            "field"=>"age"
                        ]
                    ],
                    "maxage"=>[
                            "max"=>[
                                "field"=>"age"
                            ]
                        ]
                ]
        ]
    ];


    
    print_r(json_encode($params['body']));
    
    $rep=$client->search($params);



echo"<hr/>";
$aggs=$rep['aggregations'];
$byage= $aggs['byage'];
echo "la moy est :<h1>".$byage['value']."</h1>";

$byage= $aggs['maxage'];
echo "max est :<h1>".$byage['value']."</h1>";
?>