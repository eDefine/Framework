<?php

namespace Edefine\Framework\Http;

use Edefine\Framework\Storage\UploadedFile;

/**
 * Class UploadedFilesBuilder
 * @package Edefine\Framework\Http
 */
class UploadedFilesBuilder
{
    /**
     * @param array $data
     * @return array
     */
    public static function buildFromNamedForm(array $data)
    {
        self::validateNamedForm($data);

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

    /**
     * @param array $data
     * @return array
     */
    public static function buildFromUnnamedForm(array $data)
    {
        self::validateUnnamedForm($data);

        $files = [];
        foreach ($data as $field => $array) {
            if ($array['error'] == 0) {
                $file = new UploadedFile();
                $file->setName($array['name']);
                $file->setType($array['type']);
                $file->setPath($array['tmp_name']);
                $file->setError($array['error']);
                $file->setSize($array['size']);

                $files[$field] = $file;
            }
        }

        return $files;
    }

    /**
     * @param array $data
     */
    private static function validateNamedForm(array $data)
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

    /**
     * @param array $data
     */
    private static function validateUnnamedForm(array $data)
    {
        foreach ($data as $field => $array) {
            if (!isset($array['name'])) {
                throw new \RuntimeException('"name" key is missing');
            }

            if (!isset($array['type'])) {
                throw new \RuntimeException('"type" key is missing');
            }

            if (!isset($array['tmp_name'])) {
                throw new \RuntimeException('"tmp_name" key is missing');
            }

            if (!isset($array['error'])) {
                throw new \RuntimeException('"error" key is missing');
            }

            if (!isset($array['size'])) {
                throw new \RuntimeException('"size" key is missing');
            }
        }
    }
}