<?php

// Convert to hexastore

$filename = dirname(__FILE__) . '/all.nt';

$file_handle = fopen($filename, "r");


$triples = array();


while (!feof($file_handle)) 
{
	$line = trim(fgets($file_handle));
	
	// <http://88.208.205.92/index.php?option=com_content&view=article&id=212&Itemid=245> <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://xmlns.com/foaf/0.1/Document> .

	// triples with object as URI
	if (preg_match('/<(http.*)>\s+<(http.*)>\s+<(http.*)>\s+\./', $line, $m))
	{
		//print_r($m);
		$triple = array($m[1], $m[2], $m[3]);
		$triples[] = $triple;
	}

	// triples with object as literal
	if (preg_match('/<(http.*)>\s+<(http.*)>\s+"(.*)"\s+\.$/', $line, $m))
	{
		//print_r($m);
		
		$triple = array($m[1], $m[2], $m[3]);
		$triples[] = $triple;
	}
	
	
	
}

echo json_encode($triples, JSON_PRETTY_PRINT);
