<?php

namespace Edefine\Framework\Http;

use Edefine\Framework\Storage\UploadedFile;

class UploadedFilesBuilder
{
    public static function build(array $data)
    {
        self::validate($data);

        $files = [];
        foreach ($data['name'] as $field => $name) {
            if ($data['error'][$field] == 0) {
                $file = new UploadedFile();
                $file->setName($name);
                $file->setType($data['type'][$field]);
                $file->setPath($data['tmp_name'][$field]);
                $file->setError($data['error'][$field]);
                $file->setSize($data['size'][$field]);

                $files[$field] = $file;
            }
        }

        return $files;
    }

    private static function validate(array $data)
    {
        if (!isset($data['name'])) {
            throw new \RuntimeException('"name" key is missing');
        }

        if (!isset($data['type'])) {
            throw new \RuntimeException('"type" key is missing');
        }

        if (!isset($data['tmp_name'])) {
            throw new \RuntimeException('"tmp_name" key is missing');
        }

        if (!isset($data['error'])) {
            throw new \RuntimeException('"error" key is missing');
        }

        if (!isset($data['size'])) {
            throw new \RuntimeException('"size" key is missing');
        }
    }
}