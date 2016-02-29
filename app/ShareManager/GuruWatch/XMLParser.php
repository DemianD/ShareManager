<?php namespace App\ShareManager\GuruWatch;

class XMLParser {


    public static function getXMLDataInArray($url)
    {
        $data = file_get_contents($url);
        libxml_use_internal_errors(true);
        return simplexml_load_string($data);
    }


}