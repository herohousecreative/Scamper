<html> 
<head> 
<basefont face="Arial"> 
</head> 
<body> 
<?php 

// run when start tag is found 
function startElementHandler($parser, $name, $attributes) 
{
      echo "Found opening tag of element: <b>$name</b> <br>"; 

      // process attributes 
      while (list ($key, $value) = each ($attributes)) 
      {
            echo "Found attribute: <b>$key = $value</b> <br>"; 
      } 
} 

// run when end tag is found 
function endElementHandler($parser, $name) 
{
      echo "Found closing tag of element: <b>$name</b> <br>"; 
} 
// run when cdata is found 
function characterDataHandler($parser, $cdata) 
{
      echo "Found CDATA: <i>$cdata</i> <br>"; 
} 

// XML data file 
$xml_file = "fox.xml"; 

// initialize parser 
$xml_parser = xml_parser_create(); 

// set callback functions 
xml_set_element_handler($xml_parser, "startElementHandler", "endElementHandler"); 
xml_set_character_data_handler($xml_parser, "characterDataHandler"); 

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

