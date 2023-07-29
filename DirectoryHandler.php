<?php
require_once 'config.php';

class DirectoryHandler
{
    private string $currentDirectory;

    public function __construct(private string $startDirectory)
    {
        $this->currentDirectory = $_SESSION['current_directory'] ?? $this->startDirectory;
        $_SESSION['home_directory'] = $this->startDirectory;
    }

    public function getAbsolutePath(): string
    {
        return realpath($this->currentDirectory);
    }

    public function scanDirectory(): array
    {
        $contents = scandir($this->currentDirectory);
        $result = [];
        foreach ($contents as $item) {
            if ($item !== '.' && $item !== '..') {
                $result[] = $item;
            }
        }
        return $result;
    }

    public function navigateTo(string $directory): void
    {
        $this->currentDirectory = realpath($this->currentDirectory . DIRECTORY_SEPARATOR . $directory);
        $_SESSION['current_directory'] = $this->currentDirectory;
    }

    public function back(): void
    {
        $this->currentDirectory = $this->startDirectory;
        $_SESSION['current_directory'] = $this->currentDirectory;
    }

}