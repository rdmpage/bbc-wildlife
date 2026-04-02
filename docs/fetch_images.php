<?php 

require_once('lib.php');

$filename = 'data.json';

$file_handle = fopen($filename, "r");

$count = 0;

while (!feof($file_handle)) 
{
	$line = trim(fgets($file_handle));
	
	//echo $line . "\n";
	
	$line = str_replace('\/', '/', $line);

	// http:\/\/ichef.bbci.co.uk\/naturelibrary\/images\/ic\/640x360\/p\/pa\/palearctic_ecozone\/palearctic_ecozone_1.jpg",
	if (preg_match('/"(?<url>http:\/\/ichef.bbci.co.uk\/naturelibrary\/images\/.*.jpg)"/Uu', $line, $m))
	{
		//print_r($m);
		
		$image_url = $m['url'];
		
		$image_filename = str_replace('http://ichef.bbci.co.uk/naturelibrary/', '', $image_url);
		
		//echo $image_filename . "\n";
		
		$parts = explode("/", $image_filename);
		
		$n = count($parts) - 1;
		
		$path = dirname(__FILE__);
		
		for ($i = 0; $i < $n; $i++)
		{
			$path .= '/' . $parts[$i];
			
			if (!file_exists($path))
			{
				$oldumask = umask(0); 
				mkdir($path, 0777);
				umask($oldumask);
			}
			
			//echo $path . "\n";
		}
		
		$image = get($image_url);
		
		file_put_contents($image_filename , $image);
		
		
		
	}
}

?>
