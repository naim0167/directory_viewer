<?php
require_once 'config.php';

class DirectoryHandler
{
    private string $currentDirectory;

    public function __construct(private string $startDirectory)
    {
        $this->currentDirectory = $this->startDirectory;
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

    public function handleNavigation(): void
    {
        if (isset($_GET['directory'])) {
            $selectedDirectory = $_GET['directory'];
            $this->currentDirectory = realpath($this->currentDirectory . DIRECTORY_SEPARATOR . $selectedDirectory);
            $_SESSION['current_directory'] = $this->currentDirectory;
        }
    }

    public function back(): void
    {
        if (isset($_GET['back'])) {
            $this->currentDirectory = $this->startDirectory;
            $_SESSION['current_directory'] = $this->currentDirectory;
        }
    }

}