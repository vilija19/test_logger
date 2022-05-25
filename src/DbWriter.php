<?php
 
namespace Vilija\hw_9;

/**
 * Класс FileWriter реализует запись в Базу Данных SQLite сообщений лога
 * @package vilija19/logger
 */
class DbWriter implements WriterInterface
{
    protected $dataBaseName = 'logDB';
    /**
     * Свойство хранит объект соединения с базой данных
     * @var Object
     * @access private
     */
    private $dataDaseHandler;

    /**
     * Свойство хранит объект форматтера
     * @var Object
     * @access protected
     */    
    protected $formatter;

    public function __construct(FormatterInterface $formaterObj,string $dataBaseName = null)
    {
        if ($dataBaseName) {
            $this->dataBaseName = $dataBaseName; 
        } 
        $this->dataDaseHandler = new \SQLite3($this->dataBaseName);
        $this->dataDaseHandler->exec("CREATE TABLE IF NOT EXISTS logMessages(id INTEGER PRIMARY KEY,
         level varchar(10) , message TEXT)");        
    
        $this->formatter = $formaterObj;       
    }

    /**
     * Это метод пишет сообщение лога в базу данных
     * @var string $level - уровень сообщения
     * @var string $message
     * @var array $context -необязательный ассоциативный массив переменных . 
     * Пример ['arg1' => $a,'arg2' => $b]
     * @return void
     */
    public function write($level, string $message, array $context = []): void
    {
        $messageString = $this->formatter->format($level,$message,$context);

        $this->dataDaseHandler->exec("INSERT INTO logMessages(level,message) VALUES('$level','$messageString')");
        
        $this->read();
    }
    /**
     * Это метод читает все сообщения лога из базы данных.
     * И выводит их в консоль.
     * @return void
     */
    public function read()
    {
        $res = $this->dataDaseHandler->query('SELECT * FROM logMessages');
        echo 'DataBase content:' . PHP_EOL;
        while ($row = $res->fetchArray()) {
            echo "{$row['id']} {$row['level']} {$row['message']}".PHP_EOL;
        }
    }

}