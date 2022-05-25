<?php

namespace Vilija\hw_9;

interface FormatterInterface
{
    /**
     *
     * Creating string from message parameters for write to log
     *
     * @var string $level - уровень сообщения
     * @var string $message
     * @var array $context -необязательный ассоциативный массив переменных . 
     * @return string
     */     
    public  function format($level, string $message, array $context = []): string;
   
}