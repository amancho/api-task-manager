<?php declare(strict_types=1);

namespace Tappx\Tasks\TasksManager\Infrastructure\Storage\Error;

use Exception;

final class FileNotFound extends Exception
{
    public static function message(string $filePath): self
    {
        return new self(\sprintf('File %s not found', $filePath));
    }
}
