<?php

// Merge RDF/XML files into single n-triples file

require_once(dirname(__FILE__) . '/arc2/ARC2.php');


//--------------------------------------------------------------------------------------------------
function rdf_to_triples($xml)
{	
	// Parse RDF into triples
	$parser = ARC2::getRDFParser();		
	$base = 'http://www.bbc.co.uk';
	$parser->parse($base, $xml);	
	
	$triples = $parser->getTriples();
	
	//print_r($triples);
	
	// clean up
	
	$cleaned_triples = array();
	foreach ($triples as $triple)
	{
		$add = true;

		if ($triple['s'] == 'http://example.com/')
		{
			$add = false;
		}
		
		if ($add)
		{
			$cleaned_triples[] = $triple;
		}
	}
	
	return $parser->toNTriples($cleaned_triples);
	

}



$basedir = dirname(dirname(__FILE__)) . '/ecozones';
//$basedir = dirname(dirname(__FILE__)) . '/adaptations';
//$basedir = dirname(dirname(__FILE__)) . '/habitats';
//$basedir = dirname(dirname(__FILE__)) . '/life';

$files = scandir($basedir);


$files = array('Palearctic_ecozone.rdf');

foreach ($files as $filename)
{
	echo "filename=$filename|\n";
	
	if (preg_match('/\.rdf$/', $filename))
	{	
		$rdf = file_get_contents($basedir . '/' . $filename);
		
		//echo $rdf;
		
		// fix stuff
		
		$rdf = str_replace('<dc:description>', '<dc:description><![CDATA[', $rdf);
		$rdf = str_replace('</dc:description>', ']]></dc:description>', $rdf);

		// convert to triples
		$triples = rdf_to_triples($rdf);

		echo $triples;

	}
}

?>

