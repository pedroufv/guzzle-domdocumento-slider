<?php

require 'vendor/autoload.php';

$base_uri = '';

$client = new GuzzleHttp\Client(['base_uri' => $base_uri]);

$result = $client->get('/fotos');

$doc = new DOMDocument();
$doc->loadHTML($result->getBody()->getContents());

$links = $doc->getElementsByTagName('a');
?>

<script>
var i = 0;
var images = [];
var time = 2500;

<?php 
foreach($links as $index => $link): 
    $filename = $link->getAttribute('href');	
    if (!strpos(strtolower($filename), 'jpg'))
       continue; 
?>

images[<?=$index?>] = "<?=$base_uri.'/fotos/'.$filename?>";

<?php endforeach; ?>

function changeImg(){
    document.slide.src = images[i];
      
    if(i > images.length - 1)
        i = 0;

    ++i;
 
    setTimeout("changeImg()", time);
}

window.onload=changeImg;
</script>

<img name="slide" width="400" height="600" /> 
