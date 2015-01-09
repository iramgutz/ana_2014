<?php 

error_reporting(E_ERROR);
error_reporting(E_ALL);
ini_set("display_errors", 1);


class XmlConstruct extends XMLWriter 
{ 

    /** 
     * Constructor. 
     * @param string $prm_rootElementName A root element's name of a current xml document 
     * @param string $prm_xsltFilePath Path of a XSLT file. 
     * @access public 
     * @param null 
     */ 
    public function __construct($prm_rootElementName = false, $prm_xsltFilePath=''){ 
        $this->openMemory(); 
        $this->setIndent(true); 
        $this->setIndentString(' '); 
        $this->startDocument('1.0', 'UTF-8'); 

        if($prm_xsltFilePath){ 
            $this->writePi('xml-stylesheet', 'type="text/xsl" href="'.$prm_xsltFilePath.'"'); 
        } 
        if($prm_rootElementName)
        {
            $this->startElement($prm_rootElementName); 
        }
        
    } 

    /** 
     * Set an element with a text to a current xml document. 
     * @access public 
     * @param string $prm_elementName An element's name 
     * @param string $prm_ElementText An element's text 
     * @return null 
     */ 
    public function setElement($prm_elementName, $prm_ElementText , $prm_ElementAttributes = array()){ 
        $this->startElement($prm_elementName); 
        foreach($prm_ElementAttributes as $key => $value)
        {
            $this->writeAttribute($key , $value); 
        }
        $this->text($prm_ElementText); 
        $this->endElement(); 
    } 

    /** 
     * Construct elements and texts from an array. 
     * The array should contain an attribute's name in index part 
     * and a attribute's text in value part. 
     * @access public 
     * @param array $prm_array Contains attributes and texts 
     * @return null 
     */ 
    public function fromArray($prm_array){ 

        
      if(is_array($prm_array)){ 
        foreach ($prm_array as $index => $element){ 
          if(is_array($element['content'])){ 
            $this->startElement($index);

            if(!empty($element['attributes']))
            {
                foreach($element['attributes'] as $key => $value)
                {
                    $this->writeAttribute($key , $value); 
                }   
            }
            
             
            $this->fromArray($element['content']); 
            $this->endElement(); 
          } 
          else {
            $attributes = (empty($element['attributes'])) ? array() : $element['attributes']; 
            $this->setElement($index, $element['content'] , $attributes);
          }
                     
        } 
      } 
    } 

    /** 
     * Return the content of a current xml document. 
     * @access public 
     * @param null 
     * @return string Xml document 
     */ 
    public function getDocument(){ 
        $this->endElement(); 
        $this->endDocument(); 
        return $this->outputMemory(); 
    } 

    /** 
     * Output the content of a current xml document. 
     * @access public 
     * @param null 
     */ 
    public function output(){ 
        header('Content-type: text/xml'); 
        echo $this->getDocument(); 
    } 
   

} 

?>