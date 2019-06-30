<?php

namespace Joyching\I18n;

use Storage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;

class Export
{
    private $path;
    private $translations = [];
    private $locale;

    public function __construct()
    {
        $this->path = Config::get('i18ntool.path');
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
        $this->path = sprintf('%s/%s', $this->path, $locale);

        return $this;
    }

    public function toCsv($locale = null)
    {
        $this->scan($this->path);

        if (! file_exists(storage_path('app/i18n-exports'))) {
            Storage::disk('local')->makeDirectory('i18n-exports');
        }

        foreach ($this->translations as $locale => $groups) {
            $fp = fopen(storage_path("app/i18n-exports/{$locale}.csv"), 'w');

            foreach ($groups as $group => $data) {
                $this->write($fp, $group, $data);
            }

            fclose($fp);
        }

        return true;
    }

    private function scan($dir)
    {
        $paths = glob("{$dir}/*");

        foreach ($paths as $key => $value) {
            if (is_dir($value)) {
                $this->scan($value);

                continue;
            }

            $filename = $this->getFileName($value);
            $locale = $this->getLocale($value);

            $this->translations[$locale][$filename] = Lang::getLoader()->load($locale, $filename);
        }
    }

    private function getFileName($path)
    {
        return str_replace('.php', '', basename($path));
    }

    private function getLocale($path)
    {
        return basename(str_replace(basename($path), '', $path));
    }

    private function write($fp, $group, array $data, $prefix = null)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $this->write($fp, $group, $value, $key);

                continue;
            }

            $name = is_null($prefix) ? "{$group}.{$key}" : "{$group}.{$prefix}.{$key}";

            fputcsv($fp, [$name, $value]);
        }
    }
}
