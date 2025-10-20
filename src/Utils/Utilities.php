<?php

namespace Nyxcode\PhpSifenTool\Utils;

class Utilities
{
    /**
     * Generate a random string.
     *
     * @param int $length
     * @return string
     */
    public static function randomString(int $length = 16): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Check if a string is a valid JSON.
     *
     * @param string $string
     * @return bool
     */
    public static function isJson(string $string): bool
    {
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }

    /**
     * Convert array to object recursively.
     *
     * @param array<string|int, mixed> $array
     * @return object
     */
    public static function arrayToObject(array $array): object
    {
        return json_decode(json_encode($array), false);
    }

    /**
     * Sanitize a string for output.
     *
     * @param string $string
     * @return string
     */
    public static function sanitize(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Remove XML prolog from an XML string.
     *
     * @param string $xml
     * @return string
     */
    public static function removeXmlProlog(string $xml): string
    {
        return preg_replace('/<\?xml.*?\?>\s*/i', '', $xml, 1);
    }
}
