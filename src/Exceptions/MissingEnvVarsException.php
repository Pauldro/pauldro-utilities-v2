<?php namespace Pauldro\UtilityBelt\Exceptions;

class MissingEnvVarsException extends Exception {
    protected $vars = [];
    protected $filepath = '';

    public function setVars(array $vars) : void 
    {
        $this->vars = $vars;
    }

    /**
     * Set .env filepath
     * @param  string $filepath
     * @return void
     */
    public function setFilepath($filepath) : void 
    {
        $this->filepath = $filepath;
    }

    /**
     * Generate Error Message
     * @return void
     */
    public function generateMessage() : void
    {
        $msg = '.env missing variables: ' . implode(", ", $this->vars);

        if ($this->filepath) {
            $msg .= " (.env file: $this->filepath)";
        }
        $this->message = $msg;
    }
}
