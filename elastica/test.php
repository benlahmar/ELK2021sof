<?php

require_once 'vendor/autoload.php';
use \Elastica\Query\Term;
use \Elastica\Query;
use \Elastica\Query\Match;
$client = new \Elastica\Client();
$search = new Elastica\Search($client);

$search->addIndex('bank2022');

$term = new Term(["gender"=>"female"]);
$match= new Match("gender","male");

$query= new Query();
$query->setQuery($match);

$search->setQuery($query);
$resset=$search->search();

$res=$resset->getResults();
foreach($res as $r)
{
    var_dump($r->getData());
    echo "age:    ".$r->getScore();
}

?>