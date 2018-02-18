<html> 
<head> 
<title>2.4 Example</title><basefont face="Arial"> 
</head> 
<body> 

<?php 

// run when start tag is found 
function startElementHandler($parser, $name, $attributes) 
{
      echo "<ul><li>$name</li>"; 
}   
function endElementHandler($parser, $name) 
{
      echo "</ul>"; 
} 

// XML data file 
$xml_file = "letter.xml"; 

// initialize parser 
$xml_parser = xml_parser_create(); 

// set element handler 
xml_set_element_handler($xml_parser, "startElementHandler", "endElementHandler"); 

// read XML file 
if (!($fp = fopen($xml_file, "r"))) 
{
      die("File I/O error: $xml_file"); 
} 

// parse XML 
while ($data = fread($fp, 4096)) 
{
      // error handler 
      if (!xml_parse($xml_parser, $data, feof($fp))) 
      {
            die("XML parser error: " . 
xml_error_string(xml_get_error_code($xml_parser))); 
      } 
} 

// all done, clean up! 
xml_parser_free($xml_parser); 
?> 
</body> 
</html> 
