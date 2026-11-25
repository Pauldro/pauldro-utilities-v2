<?php namespace Pauldro\UtilityBelt\Files;
// Base PHP
use SplFileInfo;

class File extends SplFileInfo
{
    public function countFiles(): int
    {
        if ($this->isFile()) {
            return 1;
        }
        if ($this->isDir() === false) {
            return 0;
        }
        return count(glob($this->getPathname() . '/*', 0));
    }

    /**
     * @param string|array $extension
     */
    public function countFilesWithExtension($extension): int
    {
        if ($this->isFile()) {
            return 1;
        }
        if ($this->isDir() === false) {
            return 0;
        }
        if (is_array($extension)) {
            $extensions = "{" . implode(',', $extension) ."}";
            return count(glob($this->getPathname() . "/*.$extensions", GLOB_BRACE));
        }
        return count(glob($this->getPathname() . "/*.$extension", 0));
    }

    /**
     * @param string|array $extension
     */
    public function hasExtension($extension): bool
    {
        if (is_array($extension)) {
            return in_array($this->getExtension(), $extension);
        }
        return $this->getExtension() == $extension;
    }
}
