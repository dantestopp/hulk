<?php
namespace Hulk;

/**
 * @category Facade
 * @package Hulk
 * @author happyoniens <dante.stoppini@gmail.com>
 * @license https://github.com/happyoniens/hulk/blob/master/LICENSE MIT
 * @link https://github.com/happyoniens/hulk
 */
class Hulk
{

    /**
     * Don't allow object instantiation
     */
    private function __construct()
    {
    }

    /**
     * Don't allow object instantiation
     */
    private function __destruct()
    {
    }

    /**
     * Don't allow object instantiation
     * @return nothing
     */
    private function __clone()
    {
    }

    private static $heart = null;

    private static $initialized = false;

    /**
    * Handles calls to static methods.
    *
    * @param string $name   Method name
    * @param array  $params Method parameters
    * @return mixed Callback results
    */
    public static function __callStatic($name, $params)
    {

        if (self::$initialized == false) {
            self::$heart = new Core\Heart();
            self::$initialized = true;
        }
    }
}
