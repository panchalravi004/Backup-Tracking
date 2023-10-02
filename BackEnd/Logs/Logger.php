<?php

class Logger{   

    private $filePath  = '../Logs/logs.txt';
    private $className;

    public function __construct($className) {
        $this->className = $className;

    }

    function msg($functionName, $status, $msg ){
        
        $date = new DateTime();
        $date = $date->format("y:m:d h:i:s");

        $status = str_pad($status,10," ");
        $errorPath = str_pad($this->className,20," ")."::".str_pad($functionName,20," ");

        $errorMsg = $date." ".$status." ".$errorPath." -::- ".$msg."\n";

        error_log($errorMsg, 3, $this->filePath);

    }

}