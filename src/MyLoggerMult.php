<?php
/**
 * тестовый логгер
 * 
 * @author Alex <billibons777@gmail.com>
 * @version 1.0
 * @package vilija19/logger
 */

namespace Vilija\hw_9;

use Stringable;

/**
 * Класс MyLoggerMult
 * Реализует запись сообщений лога в различные типы хранния данных 
 * @package vilija19/logger
 */
class MyLoggerMult extends \Psr\Log\AbstractLogger
{
    /**
     * Эта переменная хранит массив обьектов writers
     * @var array 
     * @access protected
     */
    protected $writers;

    public function __construct(array $writersArray)
    {
        $this->writers = $writersArray;
    }

    /**
     * Это метод пишет сообщение лога в переданные ему writers
     * @var string $level - уровень сообщения
     * @var string $message
     * @var array $context -необязательный ассоциативный массив переменных . 
     * Пример ['arg1' => $a,'arg2' => $b]
     * @return void
     */
    public function log($level, string|Stringable $message, array $context = []): void
    {
        foreach ($this->writers as $writer) { 
            $writer->write($level,$message,$context);
        }
    }

}