<?php
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

//recuperer les femmes avec term

$params=[
    "index"=>"bank2022",
    "body"=>[
        "query"=>[
            "term"=>[
                "gender"=>[
                    "value"=>"female"
                ]
            ]
        ]
    ]
];


$rep=$client->search($params);
print_r(json_encode($params['body']));
echo"<hr/>";
var_dump($rep);
?>
