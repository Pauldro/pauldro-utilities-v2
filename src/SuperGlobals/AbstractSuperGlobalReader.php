<?php namespace Pauldro\UtilityBelt\SuperGlobals;

abstract class AbstractSuperGlobalReader
{
    public const GET_OPTIONS = [
        'default' => null
    ];

    abstract public static function superglobal(): array;

    public static function exists(string $key): bool
    {
        return array_key_exists($key, static::superglobal());
    }

    /**
     * @param  array{default?:null|mixed} $opts
     */
    public static function get(string $key, $opts = []): mixed
    {
        $opts = array_merge(static::GET_OPTIONS, $opts);

        if (static::exists($key) === false) {
            return $opts['default'];
        }
        return static::superglobal()[$key];
    }
}
