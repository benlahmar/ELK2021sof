<?php

require_once 'vendor/autoload.php';
use \Elastica\Query\Term;
use \Elastica\Query;
use \Elastica\Query\BoolQuery;
use \Elastica\Query\Match;

$client = new \Elastica\Client();
$search = new Elastica\Search($client);

$search->addIndex('bank2022');

$bool=new BoolQuery();
//les comptes des femmes de preference d'age est entre 20 et 30 ans
$term = new Term(["gender"=>"female"]);
$match= new Match("city","casa");

$bool->addMust($term);
$bool->addShould($match);

$query= new Query();
$query->setQuery($bool);

$q=$query->toArray();
echo json_encode($q);

$search->setQuery($query);
$resset=$search->search();

$res=$resset->getResults();
foreach($res as $r)
{
    var_dump($r->getData());
    echo "age:    ".$r->getScore();
}

?>