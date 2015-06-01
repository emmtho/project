<?php
//get the q parameter from URL
//$q=$_GET["q"];

$q = "Google";
//find out which feed was selected
if($q=="Google") {
  $xml=("http://dbwebb.se/forum/feed.php");
} elseif($q=="NBC") {
  $xml=("http://rss.msnbc.msn.com/id/3032091/device/rss/rss.xml");
}

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//var_dump($xmlDoc->saveXML());

//get elements from "<channel>"
$channel=$xmlDoc->getElementsByTagName('feed')->item(0);
//var_dump($channel);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
echo("<h1>" . $channel_title . "</h1>");
/*$channel_desc = $channel->getElementsByTagName('description')
->item(0)->childNodes->item(0)->nodeValue;

//output elements from "<channel>"
echo("<p><a href='" . $channel_link
  . "'>" . $channel_title . "</a>");
echo("<br>");
echo($channel_desc . "</p>");
//echo("<p>" . $channel . "</p>");*/

//get and output "<item>" elements
$x=$xmlDoc->getElementsByTagName('entry');
for ($i=0; $i<=2; $i++) {
  $item_title=$x->item($i)->getElementsByTagName('title')
  ->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')
  ->item(0)->nodeValue;
  $item_content=$x->item($i)->getElementsByTagName('content')
  ->item(0)->nodeValue;
  /*echo ("<h2><a href='" . $item_link . "'>" . $item_title . "</a>");
  echo ("<br>");
  echo ($item_desc . "</p>");*/
  echo("<h2><a href='" . $item_link . "'>" . $item_title . "</a></h2>");
  echo($item_content);
}
?>
