<?php

enum Format
{
    case JSON;
    case XML;

    public function getSerializer(): Serializer
    {
        return match ($this) {
            self::JSON => new JsonSerializer(),
            self::XML => new XMLSerializer(),
        };
    }

    public static function fromString(string $format): Format|null
    {
        return match (strtolower($format)) {
            'json' => self::JSON,
            'xml' => self::XML,
            default => null,
        };
    }
}