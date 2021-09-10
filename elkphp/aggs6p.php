<?php
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

$params=[
    "index"=>"bank2022",
    "body"=>[
        "size"=>0,
  "aggs"=>[
    "aa"=>[
      "composite" =>[
        "sources"=> [

          [
            "xx"=>[
              "terms"=>[
                "field"=> "gender.keyword"
               
              ]
            ]
              ],
          [
            "yy"=>[
              
                "histogram"=>[
                "field"=> "age",
                "interval"=> 10
                
                ]
            ]
          ]
        ]
      ]
    ]
    
    
  ]
  
]];


    
    print_r(json_encode($params['body']));
    
    $rep=$client->search($params);



echo"<hr/>";
$aggs=$rep['aggregations'];
var_dump($aggs['aa']['buckets']);

$tab=$aggs['aa']['buckets'];



$dd=$aggs['aa']['buckets'][0];
var_dump($dd);

var_dump($dd['key']);
$x=$dd['key']['xx'];
$y=$dd['key']['yy'];
echo "x: ".$x."   y:  ".$y;
echo "nb doc:    ".$dd['doc_count'];
?>