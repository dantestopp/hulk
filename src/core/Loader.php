<?php
namespace Hulk\Core;

/**
 * @category Loader
 * @package Hulk
 * @author gabriellovric <lovric.gabriel@gmail.com>
 * @license https://github.com/happyoniens/hulk/blob/master/LICENSE MIT
 * @link https://github.com/happyoniens/hulk
 */
class Loader
{

    /**
     * Registered classes.
     *
     * @var array
     */
    protected $classes = array();

    /**
     * Class instances.
     *
     * @var array
     */
    protected $instances = array();

    /**
     * Autoload directories.
     *
     * @var array
     */
    protected static $dirs = array();

    /**
     * Register a class
     *
     * @return null
     */
     public function register($name, $class, array $params = [])
     {
         unset($this->instances[$name]);
         $this->classes[$name] = array($class, $params);
     }

     public function run($class)
     {
        $return = null;
        if (isset($this->classes[$class])) {
            list($class, $params) = $this->classes[$class];
            if(isset($this->instances[$class]))
            {
                $return = $this->getInstance($class);
            } else {
                $return = $this->newInstance($class, $params);
                $this->instances[$class] = $return;
            }

            return $return;
        }else{
            throw new HulkException("No class found with name {$class}");
        }
     }

    /**
     * Unregister a class
     *
     * @return null
     */
    public function unregister()
    {

    }

    /**
     * Get instance of class if doesnt exist create new one
     *
     * @return null
     */
    public function getInstance($class)
    {
        return isset($this->instances[$class]) ? $this->instances[$class] : null;
    }

    public function newInstance($class, $params = null)
    {
        return (new \ReflectionClass($class))->newInstanceArgs($params);
    }

    /**
     * Enables or disables autoloding
     *
     * @return null
     */
    public function autoload()
    {
        spl_autoload_register(array(__CLASS__, 'load'));
    }

    /**
     * Used by autoloader to load classes.
     *
     * @return null
     */
    public static function load($name)
    {
        foreach (self::$dirs as $dir) {
            $file = $dir.'/'.$name.'.php';
            if (file_exists($file)) {
                require $file;
                return;
            }
        }
    }

    public static function addDirectory($dir) {
        if (is_array($dir) || is_object($dir)) {
            foreach ($dir as $value) {
                self::addDirectory($value);
            }
        }
        else if (is_string($dir)) {
            if (!in_array($dir, self::$dirs)) self::$dirs[] = $dir;
        }
    }
}
