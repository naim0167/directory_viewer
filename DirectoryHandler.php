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
        $dirArr = explode(DIRECTORY_SEPARATOR, $this->currentDirectory);
        $currentFolder = end($dirArr);
        if ($currentFolder !== $directory) {
            $this->currentDirectory = realpath($this->currentDirectory . DIRECTORY_SEPARATOR . $directory);
            $_SESSION['current_directory'] = $this->currentDirectory;
        }
    }

    public function backToHome(): void
    {
        $this->currentDirectory = $this->startDirectory;
        $_SESSION['current_directory'] = $this->currentDirectory;
    }

    public function previous(): void
    {
        if ($this->currentDirectory === $this->startDirectory) {
            header("Location: /");
        }

        $dir = explode(DIRECTORY_SEPARATOR, $this->currentDirectory);
        array_pop($dir);
        $this->currentDirectory = implode(DIRECTORY_SEPARATOR, $dir);
        $_SESSION['current_directory'] = $this->currentDirectory;
        header("Location: /");
    }

}