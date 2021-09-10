<?php

require_once 'vendor/autoload.php';
use \Elastica\Query\Term;
use \Elastica\Query\Match;
use \Elastica\Query;
use \Elastica\Query\BoolQuery;
use \Elastica\Query\Range;
use \Elastica\Aggregation\Stats;
use \Elastica\Aggregation\Terms;
use \Elastica\Aggregation\DateHistogram;
$client = new \Elastica\Client();
$search = new Elastica\Search($client);

$search->addIndex('bank2022');

$query= new Query();
//repartition des operations des comptes des f/h par mois
//
$terms=new Terms('gender');
$terms->setField('gender.keyword');

$dh=new DateHistogram("bymois","operations.operationDate","year");

$terms->addAggregation($dh);

$query->addAggregation($terms);

$q=$query->toArray();
echo json_encode($q);

$search->setQuery($query);
$resset=$search->search();
//var_dump($resset->getAggregation('gender'));

$gender=$resset->getAggregation('gender');
var_dump($gender['buckets']);
foreach($gender['buckets'] as $backet)
{
    echo $backet['key'];
    echo $backet['doc_count'];
    var_dump($backet['bymois']);
}
?>