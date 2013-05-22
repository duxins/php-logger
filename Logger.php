<?php
class Logger{
    const LEVEL_ERROR = 1;
    const LEVEL_WARNING = 2;
    const LEVEL_INFO =  3;
    const LEVEL_DEBUG =  4;

    const COLOR_RED = 31;
    const COLOR_GREEN = 32;
    const COLOR_YELLOW = 33;
    const COLOR_BLUE = 34;

    protected $level;

    public function __construct($level = self::LEVEL_DEBUG){
        if(is_string($level)){
            $level = $this->_get_level_num($level);
        }

        $this->level = $level;
    }

    public function debug($msg, $color = 0){
        $this->_log('DEBUG', $msg, $color);
    }

    public function info($msg, $color = 0){
        $this->_log('INFO', $msg, $color);
    }

    public function error($msg, $color = 0){
        $this->_log('ERROR', $msg, $color);
    }

    public function warning($msg, $color = 0){
        $this->_log('WARNING', $msg, $color);
    }

    protected function _log($level_string, $msg, $color = 0){
        $level = $this->_get_level_num($level_string);
        if($level > $this->level){
            return;
        }

        if($color){
            $msg = "\033[0;${color}m".$msg."\033[0m";
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
