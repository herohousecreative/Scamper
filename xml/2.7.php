<html> 
<head> 
<basefont face="Arial"> 
</head> 
<body> 

<?php 
// cdata handler 
function characterDataHandler($parser, $data) 
{
      echo $data; 
} 

// XML data 
$xml_string = <<<EOF
<?xml version="1.0"?> 
<message> 
      <from>Agent 5292</from> 
      <to>Covert-Ops HQ</to> 
      <encoded_message> 
      <![CDATA[
      563247 !#9292 73%639 1^2736 @@6473 634292 930049 292$88 *7623&& 62367& 
      ]]> 
      </encoded_message> 
</message> 
EOF;

// initialize parser 
$xml_parser = xml_parser_create(); 

// set cdata handler 
xml_set_character_data_handler($xml_parser, "characterDataHandler"); 

if (!xml_parse($xml_parser, $xml_string)) 
{
      die("XML parser error: " . 
xml_error_string(xml_get_error_code($xml_parser))); 
} 

// all done, clean up! 
xml_parser_free($xml_parser); 

?> 
</body> 
</html> 

