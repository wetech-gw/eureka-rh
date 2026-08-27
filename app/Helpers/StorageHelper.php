<?php

if (!function_exists('storage_url')) {
    function storage_url(string $path): string
    {
        if (!$path) {
            return '#';
        }

        $path = trim($path, '/');
        $systemPath = DIRECTORY_SEPARATOR === '\\' ? str_replace('\\', '/', $path) : $path;

        static $useSymlink = null;
        if ($useSymlink === null) {
            $symlinkExists = false;
            try {
                $symlinkExists = is_dir(public_path('storage'));
            } catch (\Throwable $e) {
                $symlinkExists = false;
            }
            $useSymlink = $symlinkExists;
        }

        if ($useSymlink) {
            return asset('storage/' . $systemPath);
        }

        return url(route('storage.file', ['path' => str_replace('/', '|', $systemPath)], false));
    }
}
