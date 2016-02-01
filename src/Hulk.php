<?php
namespace Hulk;

/**
 * @author happyonies
 */
class Hulk{

    // Don't allow object instantiation
    private function __construct(){}
    private function __destruct(){}
    private function __clone(){}

    private static $heart = null;

    private static $initialized = false;

    /**
    * Handles calls to static methods.
    *
    * @param string $name Method name
    * @param array $params Method parameters
    * @return mixed Callback results
    */
    public static function __callStatic($name, $params){
        
        if(self::$initialized == false){
            self::$heart = new Core\Heart();
            self::$initialized = true;
        }
    }

}
