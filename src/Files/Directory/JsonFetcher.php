<?php namespace Pauldro\UtilityBelt\Files\Directory;
// Pauldro Minicli
use Pauldro\UtilityBelt\Files\JsonFetcher as Fetcher;

/**
 * Wrapper for fetching JSON files from a single directory
 */
class JsonFetcher extends FileFetcher {
    protected string $dir;
    protected $fetcher;
    public string $errorMsg;

    public function __construct(string $dir) {
        parent::__construct($dir);
        $this->fetcher = Fetcher::instance();
    }

    /**
     * Return Filepath
     * @param  string $filename
     * @return string
     */
    public function filepath(string $filename) : string
    {
        $filename = preg_replace('/\.\w+$/', '', $filename);
        $filename .= '.json';
        return parent::filepath($filename);
    }
}
