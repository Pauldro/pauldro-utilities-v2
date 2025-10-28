<?php namespace Pauldro\UtilityBelt\SuperGlobals;

/**
 * Utility for interacting with the $_SERVER vars
 */
class ServerVarsReader extends AbstractSuperGlobalReader {
    public static function superglobal() : array
    {
        return $_SERVER;
    }

/* =============================================================
    Reads
============================================================= */
}