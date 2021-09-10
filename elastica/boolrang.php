<?php

require_once 'vendor/autoload.php';
use \Elastica\Query\Term;
use \Elastica\Query;
use \Elastica\Query\BoolQuery;
use \Elastica\Query\Range;
use \Elastica\Aggregation\Stats;

$client = new \Elastica\Client();
$search = new Elastica\Search($client);

$search->addIndex('bank2022');

$bool=new BoolQuery();
//les comptes des femmes de preference d'age est entre 20 et 30 ans
//calculer la moyenne des balance
$term = new Term(["gender"=>"female"]);

$ranges= array('from'=>20, 'to'=>30);

$range= new Range(null,$ranges);
$range->addField("age",$ranges);

$bool->addMust($term);
$bool->addShould($range);

$avg= new Stats("bymoy");
$avg->setField("balance");

$query= new Query();
$query->setQuery($bool);
$query->addAggregation($avg);

$q=$query->toArray();
echo json_encode($q);

$search->setQuery($query);
$resset=$search->search();
var_dump($resset->getAggregation('bymoy'));
echo "<h1>".$resset->getAggregation('bymoy')['max']."</h1>";
$res=$resset->getResults();
foreach($res as $r)
{
    var_dump($r);
    echo "age:    ".$r->getScore();
}

?>