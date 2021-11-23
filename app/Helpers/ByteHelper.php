<?php

namespace App\Helpers;

class ByteHelper
{
    /**
     * @return string
     */
    public static function toHuman(int $bytes = 0)
    {
        // Available units of size.
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        // Keep dividing while bytes is bigger than 1024.
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
