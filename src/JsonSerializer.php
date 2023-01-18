<?php

require_once 'Serializer.php';

class JsonSerializer implements Serializer
{
    public function serialize($data): string
    {
        return json_encode($data);
    }
}