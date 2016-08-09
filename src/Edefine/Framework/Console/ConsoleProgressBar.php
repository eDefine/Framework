<?php

namespace Edefine\Framework\Console;

/**
 * Class ConsoleProgressBar
 * @package Edefine\Framework\Console
 */
class ConsoleProgressBar
{
    const DEFAULT_BAR_LENGTH = 50;
    const DEFAULT_FILL_CHAR = '=';
    const DEFAULT_EMPTY_CHAR = ' ';

    private $barLength;
    private $fillChar;
    private $emptyChar;

    /**
     * @param int $barLength
     * @param string $fillChar
     * @param string $emptyChar
     */
    public function __construct($barLength = self::DEFAULT_BAR_LENGTH, $fillChar = self::DEFAULT_FILL_CHAR, $emptyChar = self::DEFAULT_EMPTY_CHAR)
    {
        $this->barLength = $barLength;
        $this->fillChar = $fillChar;
        $this->emptyChar = $emptyChar;
    }

    /**
     * @param int $current
     * @param int $max
     * @return string
     */
    public function progress($current = 0, $max = 100)
    {
        $filledBarNumber = (int)($current / $max * $this->barLength);

        $progressBar = str_repeat($this->fillChar, $filledBarNumber);
        $progressBar .= str_repeat($this->emptyChar, $this->barLength - $filledBarNumber);

        return sprintf('%2.0d%% [%s]', $current / $max * 100, $progressBar);
    }

    public function finish()
    {
        return str_repeat(' ', $this->barLength + 7);
    }
}