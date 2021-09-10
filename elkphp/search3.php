<?php
require 'vendor/autoload.php';

$client = Elasticsearch\ClientBuilder::create()->build();

//les doc qui appartient a la categorie : Craft //must
//et  le titre ou la description parlent du java 
//qui sont publie entre le 2015/01/01 et le 2016/01/01
$params=[
    "index"=>"myblog2022017",
    "body"=>[
       "query"=>[
        "bool"=>[
        "must"=>
               [
                   [
                       "match"=>["category"=>"craft"]
                    ]
                ],
        "should"=>
                [
                        [
                               "match"=>["title"=>"java"]
                        ],
                        [
                               "match"=>["description"=>"java"]
                        ]
                ],
        "filter"=> [
                    [
                      "range"=> [
                        "pubDate"=>[
                          "gte"=> "2015-01-01",
                          "lte"=> "2016-01-01"
                        ]
                      ]
                    ]
                    
                        ],
                        
        "minimum_should_match"=> "2"
           ]
       ]
    ]
];
$rep=$client->search($params);


print_r(json_encode($params['body']));
echo"<hr/>";
/*
afficher le max score
afficher combien de docs dans le res
si result >0
    
    afficher les titres avec leurs scores
*/
$hits=$rep['hits'];
echo "<h1>".$hits['max_score']."</h1>";
echo "valeur:   ".$hits['total']['value'];

if($hits['total']['value'] >0)
{
    foreach($hits['hits'] as $hit)
    {
            $source=$hit['_source'];
            echo $hit['_score']."<br/>";
            echo $source['title'];
            echo "<hr/>";
    }
    
}

var_dump($hits['total']['value']);


?>
