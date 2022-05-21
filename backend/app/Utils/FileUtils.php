<?php

namespace App\Utils;

class FileUtils
{
    public static function makeDirectory($path): bool
    {
        if (file_exists($path)) {
            return true;
        }
        return mkdir($path, 0755, true);
    }

    public static function removeFile($path): bool
    {
        return file_exists($path) && is_file($path) && @unlink($path);
    }

}
