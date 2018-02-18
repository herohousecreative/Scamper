<html> 
<head> 
<title>2.5 Example</title><basefont face="Arial"> 
</head> 
<body> 

<?php 

// cdata handler 
function characterDataHandler($parser, $data) 
{
      echo $data; 
} 

// XML data 
$xml_data = <<<EOF
<?xml version="1.0"?> 
<grammar> 
      <noun type="proper">Mary</noun> <verb tense="past">had</verb> a 
<adjective>little</adjective> <noun type="common">lamb.</noun> 
</grammar>
EOF;

// initialize parser 
$xml_parser = xml_parser_create(); 

// set cdata handler 
xml_set_character_data_handler($xml_parser, "characterDataHandler"); 

if (!xml_parse($xml_parser, $xml_data)) 
{
        die("XML parser error: " . 
xml_error_string(xml_get_error_code($xml_parser))); 
}   
// all done, clean up! 
xml_parser_free($xml_parser); 

?> 
</body> 
</html> 

