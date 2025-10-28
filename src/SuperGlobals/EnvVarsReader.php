<?php namespace Pauldro\UtilityBelt\SuperGlobals;
// Pauldro Util
use Pauldro\UtilityBelt\Data\SimpleArray;
use Pauldro\UtilityBelt\Exceptions\MissingEnvVarsException;

/**
 * Utility for interacting with the $_ENV vars
 */
class EnvVarsReader extends AbstractSuperGlobalReader {
    const GET_OPTIONS = [
        'default' => ''
    ];

    public static function superglobal() : array
    {
        return $_ENV;
    }

/* =============================================================
    Reads
============================================================= */
    public static function getBool(string $key) : bool
    {
        $value = self::get($key, ['default' => 'false']);
        return $value == 'true';
    }

    public static function getArray(string $key, $delimiter = ',') : array
    {
        return explode($delimiter, self::get($key));
    }

    public static function getInt(string $key) : int
    {
        return intval(self::get($key));
    }

    public static function getFloat(string $key) : float
    {
        return floatval(self::get($key));
    }

    /**
     * Validate Required variables are set
     * @param  array $vars
     * @throws MissingEnvVarsException
     * @return bool
     */
    public static function required(array $vars) : bool
    {
        $missing = new SimpleArray();

        foreach ($vars as $var) {
            if (self::exists($var)) {
                continue;
            }
            $missing->add($var);
        }
        if ($missing->count() == 0) {
            return true;
        }
        $e = new MissingEnvVarsException();
        $e->setVars($missing->getArray());
        $e->generateMessage();
        throw $e;
    }

    /**
     * Validate Required variables are set
     * @param  array  $vars
     * @param  string $prefix
     * @throws MissingEnvVarsException
     * @return bool
     */
    public static function requiredPrefixed(array $vars, string $prefix = '') : bool
    {
        if (empty($prefix)) {
            return self::required($vars);
        }
        $newVars = [];

        foreach ($vars as $var) {
            $newVars[] = "$prefix.$var";
        }
        return self::required($newVars);
    }
}