<?php
//http://www.devshed.com/c/a/PHP/Building-a-Template-Parser-Class-with-PHP-Part-I/4/
class templateParser
{
    var $output;

    function __construct($templateFile='default_template.htm')
    {
        if(is_readable($templateFile))
            $this->output=file_get_contents($templateFile);
        else die('Error:Template file '.$templateFile.' not found');
    }

    function parseTemplate($tags=array())
    {
        if(count($tags)>0)
        {
            foreach($tags as $tag=>$data)
            {
                //maybe we have to include file?
                if(is_readable($data))
                   $this->parseFile($data);
                $this->output=str_replace('{'.$tag.'}',$data,$this->output);
            }
        }
        else die('Error: No tags were provided for replacement');
    }

    function parseFile($file)
    {
        ob_start();
        include($file);
        $content=ob_get_contents();
        ob_end_clean();
        return $content;
    }

    function display()
    {
        return $this->output;
    }

}
?>