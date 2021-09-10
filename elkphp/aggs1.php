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
        ]
        ]
    ];
$params["body"]= <<<JSON
     {
    "aggs": {
      "avgage": {
         "avg": {
          "field": "age"
      }
    }
  }
}
JSON;
   
    print_r(json_encode($params['body']));
    
    $rep=$client->search($params);



echo"<hr/>";
var_dump($rep);


?>