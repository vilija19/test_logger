<?php
 
namespace Vilija\hw_9;

/**
 * Класс FileFormatter форматирует сообщение лога для записи в файл
 * @package vilija19/logger
 */
class FileFormatter implements FormatterInterface
{
    /**
     * Это метод форматирует сообщение лога для записи в файл
     * @var string $level - уровень сообщения
     * @var string $message
     * @var array $context -необязательный ассоциативный массив переменных . 
     * Пример ['arg1' => $a,'arg2' => $b]
     * @return string
     */
    public function format($level, string $message, array $context = []): string
    {
        $logString = '';
        $logString .= date("d-m-y H:i:s") . ' level-*' . strtoupper($level) . '* message: ' . $message;
        if (!empty($context)) { 
            foreach ($context as $key => $value) {
                $logString .= ' ' . $key . ' - ' . $value;
            }
        }
        $logString .= PHP_EOL;
        echo $logString;
        return $logString;
    }
}