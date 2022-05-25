<?php
 
namespace Vilija\hw_9;

/**
 * Класс FileWriter реализует запись в файл сообщений лога
 * @package vilija19/logger
 */
class FileWriter implements WriterInterface
{
    protected $logFile = 'logfile';
    /**
     * Свойство хранит объект форматтера
     * @var Object
     * @access protected
     */
    protected $formatter;
    
    public function __construct(FormatterInterface $formaterObj,$fileName = null)
    {
        if ($fileName) {
            $this->logFile = $fileName; 
        }
        $this->formatter = $formaterObj;       
    }

    /**
     * Это метод пишет сообщение лога в файл
     * @var string $level - уровень сообщения
     * @var string $message
     * @var array $context -необязательный ассоциативный массив переменных . 
     * Пример ['arg1' => $a,'arg2' => $b]
     * @return void
     */
    public function write($level, string $message, array $context = []): void
    {
        $messageString = $this->formatter->format($level,$message,$context);

        $handle = fopen($this->logFile, "a+");

        fwrite($handle, $messageString);

        fclose($handle);        
    }
}