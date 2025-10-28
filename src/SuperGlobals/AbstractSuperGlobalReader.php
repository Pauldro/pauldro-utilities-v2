<?php namespace Pauldro\UtilityBelt\SuperGlobals;

abstract class AbstractSuperGlobalReader {
    const GET_OPTIONS = [
        'default' => null
    ];

    abstract public static function superglobal() : array;

    public static function exists(string $key) : bool
    {
        return array_key_exists($key, static::superglobal());
    }

    /**
     * @param  string $key
     * @param  array{default?:null|mixed} $opts
     * @return mixed
     */
    public static function get(string $key, $opts = []) : mixed
    {
        $opts = array_merge(static::GET_OPTIONS, $opts);

        if (static::exists($key) === false) {
            return $opts['default'];
        }
        return static::superglobal()[$key];
    }
}