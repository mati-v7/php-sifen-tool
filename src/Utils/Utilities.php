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


    /**
     * Calculates the Modulo 11 check digit for a given string.
     *
     * This function processes the input string by converting any non-numeric characters
     * to their ASCII values and concatenating them to the numeric characters. It then
     * applies the Modulo 11 algorithm with a configurable base (default is 11) to
     * compute and return the check digit.
     *
     * @param string $number   The input string to calculate the check digit for.
     * @param int    $baseMax  The maximum base to use in the Modulo 11 calculation (default: 11).
     *
     * @return int The calculated Modulo 11 check digit.
     */
    public static function mod11(string $number, int $baseMax = 11): int
    {
        $v_total = 0;
        $v_resto = 0;
        $k = 0;
        $v_numero_aux = 0;
        $v_numero_al = '';
        $v_caracter = '';
        $v_digit = 0;

        for ($i = 0; $i < strlen($number); $i++) {
            $v_caracter = strtoupper(substr($number, $i, 1));
            if (!(ord($v_caracter) >= 48 && ord($v_caracter) <= 57)) {
                $v_numero_al = $v_numero_al . ord($v_caracter);
            } else {
                $v_numero_al = $v_numero_al . $v_caracter;
            }
        }

        $k = 2;
        $v_total = 0;
        for ($i = strlen($v_numero_al); $i > 0; $i--) {
            if ($k > $baseMax) {
                $k = 2;
            }
            $v_numero_aux = intval(substr($v_numero_al, $i - 1, 1));
            $v_total = $v_total + $v_numero_aux * $k;
            $k = $k + 1;
        }
        $v_resto = $v_total % 11;
        if ($v_resto > 1) {
            $v_digit = 11 - $v_resto;
        } else {
            $v_digit = 0;
        }
        return $v_digit;
    }
}
