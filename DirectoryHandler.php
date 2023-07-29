<?php
require_once 'config.php';

class DirectoryHandler
{
    private string $currentDirectory;

    public function __construct(private string $startDirectory)
    {
        $this->currentDirectory = $_SESSION['current_directory'] ?? $this->startDirectory;
    }

    public function getAbsolutePath(): string
    {
        return realpath($this->currentDirectory);
    }
}