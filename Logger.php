<?php
class Logger{
    const LEVEL_ERROR = 1;
    const LEVEL_WARNING = 2;
    const LEVEL_INFO =  3;
    const LEVEL_DEBUG =  4;

    const DEFAULT_LEVEL = 99;

    protected $level;

    /**
     * @param int $level
     */
    public function __construct($level = self::LEVEL_DEBUG){
        if(is_string($level)){
            $level = $this->_get_level_num($level);
        }

        $this->level = $level;
    }

    public function debug($msg){
        $this->_log('DEBUG', $msg);
    }

    public function info($msg){
        $this->_log('INFO', $msg);
    }

    public function error($msg){
        $this->_log('ERROR', $msg);
    }

    public function warning($msg){
        $this->_log('WARNING', $msg);
    }

    protected function _log($level_string, $msg){
        $level = $this->_get_level_num($level_string);
        if($level > $this->level){
            return;
        }
        $time = date('Y-m-d H:i:s');
        echo "[$time] $level_string $msg \n";
    }

    protected function _get_level_num($level){
        $level = strtoupper($level);
        $relf = new ReflectionClass('Logger');
        $consts = $relf->getConstants();
        $const_name = "LEVEL_$level";
        return isset($consts[$const_name])?$consts[$const_name]:self::LEVEL_DEBUG;
    }
}
