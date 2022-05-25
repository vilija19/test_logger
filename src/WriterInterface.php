<?php

namespace Vilija\hw_9;

interface WriterInterface
{
    /**
     *
     * Creating string from message parameters for write to log
     *
     * @var string $level - уровень сообщения
     * @var string $message
     * @var array $context -необязательный ассоциативный массив переменных . 
     * @return void
     */    
    public  function write($level, string $message, array $context = []): void;

}