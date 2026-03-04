<?php

class Config
{
    private array $data = [];

    public function __construct(string $envPath)
    {
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            //basic check if env file contain comment in first line
            if ($line[0] === '#') {
                continue;
            }

            $parts = explode('=', $line, 2);
            if (count($parts) === 2) {
                $key   = trim($parts[0]);
                $value = trim($parts[1]);
                $this->data[$key] = $value;
            }
        }
    }

    public function get(string $key, string $default = ''): string
    {
        if (!isset($this->data[$key])) {
            return $default;
        }

        return $this->data[$key];
    }
}
