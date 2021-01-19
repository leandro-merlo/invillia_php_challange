<?php

namespace App\Utils\XML;

use Illuminate\Support\Facades\Storage;

class XMLReader
{
    public static function read(string $path)
    {
        try {
            $xml = simplexml_load_file(Storage::path($path));
        } catch (\Exception $ex) {
            throw new \Exception("Falha ao tentar abrir o arquivo $path: " . $ex->getMessage());
        }
        return $xml;
    }
}
