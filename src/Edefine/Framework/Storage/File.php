<?php

namespace Edefine\Framework\Storage;

/**
 * Class File
 * @package Edefine\Framework\Storage
 */
class File
{
    private $name;
    private $type;
    private $path;
    private $size;

    /**
     * @param $content
     * @return $this
     */
    public function setContent($content)
    {
        file_put_contents($this->path, $content);

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return file_get_contents($this->path);
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        $parts = explode('.', $this->name);

        return $parts[count($parts) - 1];
    }

    /**
     * @param $path
     * @return $this
     */
    public function move($path)
    {
        $dir = dirname($path);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        move_uploaded_file($this->path, $path);
        $this->path = $path;

        return $this;
    }
}