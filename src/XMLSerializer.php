<?php

require_once 'Serializer.php';

class XMLSerializer implements Serializer
{
    public function serialize($data): string
    {
        $xml = '<data>';
        $xml .= $this->array_to_xml($data);
        $xml .= '</data>';
        return $xml;
    }

    function array_to_xml($array)
    {
        $xml = '';
        foreach ($array as $key => $value) {
            if (!is_numeric($key)) {
                $xml .= "<$key>";
                $xml .= is_array($value) ? $this->array_to_xml($value) : $value;
                $xml .= "</$key>";
            } else {
                $xml .= "<item$key>";
                $xml .= is_array($value) ? $this->array_to_xml($value) : $value;
                $xml .= "</item$key>";
            }
        }
        return $xml;
    }

}