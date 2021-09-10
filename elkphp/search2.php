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
                 "value"=> "female"
               ]
             ]
             
               ],
            "highlight"=>[
              "fields"=>[
                    "firstname"=>new \stdClass()
              ]
            ]
            
          
    ]
];

print_r(json_encode($params['body']));

$rep=$client->search($params);

echo"<hr/>";
var_dump($rep);
?>
