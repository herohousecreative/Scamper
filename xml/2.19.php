<html> 
<head> 
<title>Example 2.19</title><basefont face="Arial"> 
</head> 
<body> 

<?php 

// XML data 
$xml_data = <<<EOF
<?xml version="1.0"?> 
<shape> 
      <circle color="red" radius="5" x="14" y="574" color="red" /> 
</shape> 
EOF;

// define handlers 
function startElementHandler($parser, $name, $attributes) 
{
      // code snipped out 
} 
function endElementHandler($parser, $name) 
{
      // code snipped out 
} 

// initialize parser 
$xml_parser = xml_parser_create(); 

// set callback functions 
xml_set_element_handler($xml_parser, "startElementHandler", "endElementHandler"); 

if (!xml_parse($xml_parser, $xml_data)) 
{
      $ec = xml_get_error_code($xml_parser); 
      die("XML parser error (error code $ec): " . xml_error_string($ec) .
	  "<br>Error occurred at line " . xml_get_current_line_number($xml_parser) .
	  ", column " .
	  xml_get_current_column_number($xml_parser) . ", byte offset " .
	  xml_get_current_byte_index($xml_parser)); 
} 

// all done, clean up! 
xml_parser_free($xml_parser); 

?> 
</body> 
</html> 